<?php
use App\Zone;
use App\Pays;
use Doctrine\ORM\EntityManagerInterface;

require_once '../bootstrap.php';

// Vérifier si les données sont envoyées via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérification des données envoyées par le formulaire
    $nomZone = trim($_POST['nom'] ?? '');
    $nbHabitants = (int)($_POST['nb_habitants'] ?? 0);
    $nbPositifs = (int)($_POST['nb_positifs'] ?? 0);
    $nbSymptomatiques = (int)($_POST['nb_symptomatiques'] ?? 0);
    $paysId = (int)($_POST['pays_id'] ?? 0);
    $nouveauPays = trim($_POST['nouveau_pays'] ?? '');

    // Si des champs sont manquants
    if (empty($nomZone) || empty($paysId) && empty($nouveauPays)) {
        echo "Tous les champs doivent être remplis.";  // Message d'erreur
        exit;
    }

    // Récupérer ou créer le pays
    if ($paysId) {
        // Récupérer le pays existant à partir de son ID
        $pays = $entityManager->getRepository(Pays::class)->find($paysId);
    } elseif ($nouveauPays) {
        // Si le pays n'existe pas, le créer
        $pays = $entityManager->getRepository(Pays::class)->findOneBy(['nom' => $nouveauPays]);
        if (!$pays) {
            $pays = new Pays();
            $pays->setNom($nouveauPays);
            $entityManager->persist($pays);
            $entityManager->flush();
            echo "Nouveau pays '$nouveauPays' créé avec succès !<br>";
        }
    }

    if (!$pays) {
        echo "Le pays sélectionné ou ajouté est invalide.";
        exit;
    }

    // Créer une nouvelle zone et l'associer au pays
    $zone = new Zone();
    $zone->setNom($nomZone);
    $zone->setNbrHabitants($nbHabitants);
    $zone->setNbrPositifs($nbPositifs);
    $zone->setNbrSymptomatiques($nbSymptomatiques);
    $zone->setPays($pays);  // Associer la zone au pays
    $zone->calculStatut();  // Calculer automatiquement le statut

    // Persister la zone dans la base de données
    $entityManager->persist($zone);
    $entityManager->flush();  // Exécuter la requête pour sauvegarder la zone

    // Message de succès
    echo "Zone '" .$zone->getNom(). "' ajoutée avec succès au pays '" . $pays->getNom() . "' !";
}
