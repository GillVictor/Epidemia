<?php

use App\PointSurveillance;
use App\Zone;

require_once '../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pointId = $_GET['id'] ?? null;
    $nom = $_POST['nom'] ?? '';
    $zoneId = $_POST['zone_id'] ?? null;

    if (!$pointId || !$nom || !$zoneId) {
        header("Location: modification_point_surveillance.php?id=$pointId&error=Des informations manquent");
        exit;
    }

    $point = $entityManager->find(PointSurveillance::class, $pointId);

    if (!$point) {
        header("Location: gestion_pays.php?error=Point introuvable");
        exit;
    }

    $zone = $entityManager->find(Zone::class, $zoneId);

    if (!$zone) {
        header("Location: modification_point_surveillance.php?id=$pointId&error=Zone introuvable");
        exit;
    }

    // Mise à jour des données
    $point->setNom($nom);
    $point->setZone($zone);

    $entityManager->flush();

    header("Location: ../NiceAdmin/elements-points.php?id=$pointId&message=Modification réussie");
    exit;
}

?>
