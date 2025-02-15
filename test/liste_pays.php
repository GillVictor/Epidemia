<?php

use App\Pays;
use App\Zone;

require_once '../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paysId = $_POST['id'];
    $nom = $_POST['nom'];
    $zonesIds = $_POST['zones']; // Récupérer les IDs des zones sélectionnées

    if ($paysId) {
        // Modifier un pays existant
        $pay = $entityManager->find(Pays::class, $paysId);
        $pay->setNom($nom);
    } else {
        // Ajouter un nouveau pays
        $pay = new Pays();
        $pay->setNom($nom);
    }

    // Récupérer les zones associées
    $zones = [];
    foreach ($zonesIds as $zoneId) {
        $zone = $entityManager->find(Zone::class, $zoneId);
        if ($zone) {
            $zones[] = $zone;
        }
    }

    // Associer les zones au pays
    $pay->setZones($zones);

    $entityManager->persist($pay);
    $entityManager->flush();

    // Rediriger après l'enregistrement
    header('Location: liste_pays.php');
    exit;
}
