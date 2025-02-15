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

    // Récupérer les zones associées et les ajouter au pays
    foreach ($zonesIds as $zoneId) {
        $zone = $entityManager->find(Zone::class, $zoneId);
        if ($zone) {
            $pay->addZone($zone); // Ajouter chaque zone avec la méthode addZone
        }
    }

    // Persist et flush de l'objet pays
    $entityManager->persist($pay);
    $entityManager->flush();

    // Rediriger après l'enregistrement
    header('Location: liste_pays.php');
    exit;
}
?>
