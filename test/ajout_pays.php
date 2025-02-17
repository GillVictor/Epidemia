<?php

use App\Pays;
use App\Zone;

require_once '../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paysId = $_POST['id'];
    $nom = $_POST['nom'];
    $zonesIds = $_POST['zones']; 

    if ($paysId) {
        // Si le pays existe déjà, on le modifie
        $pay = $entityManager->find(Pays::class, $paysId);
        $pay->setNom($nom);
    } else {
        // Ajouter un nouveau pays
        $pay = new Pays();
        $pay->setNom($nom);
    }

    // Récupérer les zones associées et les ajouter au pays
    foreach ($zonesIds as $zoneId) {
        $zone = $entityManager->find(Zone::class, $zoneId);
        if ($zone) {
            $pay->addZone($zone); 
        }
    }

    $entityManager->persist($pay);
    $entityManager->flush();

    header('Location: ../NiceAdmin/forms-pays.php?message=Pays ajouté avec succès');
    exit;
}
?>
