<?php
require_once '../bootstrap.php'; 

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
        $entityManager->persist($zone);
        $entityManager->flush(); 

        $zoneId = $zone->getId();
    } else {
        // Récupérer l'objet Zone existant si une zone a été sélectionnée
        $zone = $entityManager->find(Zone::class, $zoneId);
        if (!$zone) {
            die("Erreur : Zone non trouvée.");
        }
    }

    // Créer le PointSurveillance
    $pointSurveillance = new PointSurveillance();
    $pointSurveillance->setNom($nom);
    $pointSurveillance->setZone($zone);

    // Persister le point de surveillance dans la base de données
    $entityManager->persist($pointSurveillance);
    $entityManager->flush(); 

    // Affichage d'un message de succès et redirection
    header('Location: ../NiceAdmin/forms-points.php?message=Point de surveillance ajouté avec succès');
} else {
    // En cas de mauvaise méthode de requête
    echo "Requête invalide.";
}
?>
