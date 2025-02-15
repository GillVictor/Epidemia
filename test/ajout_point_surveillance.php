<?php
require_once '../bootstrap.php'; // Inclure la configuration de Doctrine

use App\PointSurveillance;
use App\Zone;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données envoyées par le formulaire
    $nom = $_POST["nom"];
    $zoneId = $_POST["zone_id"];
    $newZoneName = $_POST["new_zone"] ?? null; // Si une nouvelle zone est créée

    // Vérifier si une nouvelle zone doit être ajoutée
    if ($zoneId === "new" && !empty($newZoneName)) {
        // Créer une nouvelle zone
        $zone = new Zone();
        $zone->setNom($newZoneName);

        // Persister la nouvelle zone dans la base de données
        //$entityManager = require '../config/bootstrap.php';
        $entityManager->persist($zone);
        $entityManager->flush(); // Confirmer l'ajout de la zone

        // Récupérer l'ID de la nouvelle zone
        $zoneId = $zone->getId();
    } else {
        // Récupérer l'objet Zone existant si une zone a été sélectionnée
        $zone = $entityManager->find(Zone::class, $zoneId);
        if (!$zone) {
            die("Erreur : Zone non trouvée.");
        }
    }

    // Créer l'objet PointSurveillance
    $pointSurveillance = new PointSurveillance();
    $pointSurveillance->setNom($nom);
    $pointSurveillance->setZone($zone);

    // Persister le point de surveillance dans la base de données
    $entityManager->persist($pointSurveillance);
    $entityManager->flush(); // Confirmer l'ajout du point de surveillance

    // Affichage d'un message de succès
    //echo "Le point de surveillance a été ajouté avec succès.";
    header('Location: ../NiceAdmin/gestion-pointSurveillance.php?message=Point de surveillance ajouté avec succès');
} else {
    // En cas de mauvaise méthode de requête
    echo "Requête invalide.";
}
?>
