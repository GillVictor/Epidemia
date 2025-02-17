<?php
use App\Zone;
use App\Pays;
require_once '../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $zoneId = $_POST['id'];
    $nom = $_POST['nom'];
    $nbHabitants = $_POST['nb_habitants'];
    $nbPositifs = $_POST['nb_positifs'];
    $nbSymptomatiques = $_POST['nb_symptomatiques'];
    $paysId = $_POST['pays_id'];
    
    // Vérifier si la zone existe
    $zone = $entityManager->find(Zone::class, $zoneId);
    if (!$zone) {
        header('Location: ../NiceAdmin/elements-zones.php?error=Zone introuvable');
        exit;
    }

    // Modifier les attributs de la zone
    $zone->setNom($nom);
    $zone->setNbrHabitants((int)$nbHabitants);
    $zone->setNbrPositifs((int)$nbPositifs);
    $zone->setNbrSymptomatiques((int)$nbSymptomatiques);
    
    // Recalculer le statut
    $zone->calculStatut();

    // Mettre à jour le pays associé
    $pays = $entityManager->find(Pays::class, $paysId);
    if ($pays) {
        $zone->setPays($pays);
    }

    // Sauvegarder en base de données
    $entityManager->persist($zone);
    $entityManager->flush();

    header('Location: ../NiceAdmin/elements-zones.php?message=Zone modifiée avec succès');
    exit;
}
?>
