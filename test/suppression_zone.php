<?php

require_once "../bootstrap.php"; 
use App\Zone;

if (isset($_POST['id'])) {
    
    $zoneId = $_POST['id'];

    $zone = $entityManager->find(Zone::class, $zoneId);

    if ($zone) {
        
        try {
            
            $entityManager->remove($zone);
            $entityManager->flush();

            header('Location: ../NiceAdmin/elements-zones.php?message=Zone supprimée avec succès');
            exit();
        } catch (Exception $e) {
           
            header('Location: ../NiceAdmin/elements-zones.php?error=Erreur lors de la suppression de la zone');
            exit();
        }
    } else {
        
        header('Location: ../NiceAdmin/elements-zones.php?error=Zone non trouvée');
        exit();
    }
} else {
    
    header('Location: ../NiceAdmin/elements-zones.php?succes=Zone supprimée avec succès');
    exit();
}
?>
