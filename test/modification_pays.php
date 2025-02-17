<?php
use App\Pays;
use App\Zone;
require_once '../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paysId = $_POST['id'];
    $nom = $_POST['nom'];
    $zonesIds = $_POST['zones'] ?? []; 
    
    // Vérifier si le pays existe
    $pay = $entityManager->find(Pays::class, $paysId);
    if (!$pay) {
        header('Location: ../NiceAdmin/elements-pays.php?error=Pays introuvable');
        exit;
    }

    // Modifier le nom du pays
    $pay->setNom($nom);

    // Mettre à jour les zones associées
    $pay->clearZones(); // Supprime les anciennes associations
    foreach ($zonesIds as $zoneId) {
        $zone = $entityManager->find(Zone::class, $zoneId);
        if ($zone) {
            $pay->addZone($zone);
        }
    }

    // Sauvegarder en base de données
    $entityManager->persist($pay);
    $entityManager->flush();

    header('Location: ../NiceAdmin/elements-pays.php?message=Pays modifié avec succès');
    exit;
}
?>
