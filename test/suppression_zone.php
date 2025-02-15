<?php
// Inclure la configuration et l'autoload de Composer (si ce n'est pas déjà fait)
require_once "../bootstrap.php"; // Assurez-vous que ce chemin est correct
use App\Zone;

// Vérifier si un ID de zone est passé par la méthode POST
if (isset($_POST['id'])) {
    // Récupérer l'ID de la zone
    $zoneId = $_POST['id'];

    // Trouver la zone dans la base de données
    $zone = $entityManager->find(Zone::class, $zoneId);

    if ($zone) {
        // Si la zone existe, on la supprime
        try {
            // Suppression de la zone
            $entityManager->remove($zone);
            $entityManager->flush();

            // Rediriger avec un message de succès
            header('Location: ../NiceAdmin/elements-zones.php?message=Zone supprimée avec succès');
            exit();
        } catch (Exception $e) {
            // Si une erreur se produit
            header('Location: ../NiceAdmin/elements-zones.php?error=Erreur lors de la suppression de la zone');
            exit();
        }
    } else {
        // Si la zone n'est pas trouvée
        header('Location: ../NiceAdmin/elements-zones.php?error=Zone non trouvée');
        exit();
    }
} else {
    // Si l'ID n'est pas fourni, rediriger avec un message d'erreur
    header('Location: ../NiceAdmin/elements-zones.php?succes=Zone supprimée avec succès');
    exit();
}
?>
