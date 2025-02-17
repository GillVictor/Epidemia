<?php
require '../bootstrap.php'; 
use App\PointSurveillance;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $pointId = $_POST['id'];

    $point = $entityManager->find(PointSurveillance::class, $pointId);
        // Supprimer le point de surveillance
        $entityManager->remove($point);
        $entityManager->flush();
}

header('Location: ../NiceAdmin/elements-points.php?message=Point de surveillance supprimé avec succès');
exit;
