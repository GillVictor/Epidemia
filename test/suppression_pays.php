<?php
require '../bootstrap.php'; 
use App\Pays;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $paysId = $_POST['id'];

    $pays = $entityManager->find(Pays::class, $paysId);
    if ($pays) {
        // Supprimer les zones associées
        foreach ($pays->getZones() as $zone) {
            $entityManager->remove($zone);
        }

        // Supprimer le pays
        $entityManager->remove($pays);
        $entityManager->flush();
    }
}
//session_start();
//$_SESSION['success'] = "Le pays a bien été supprimé.";
header('Location: ../NiceAdmin/elements-pays.php?message=Pays supprimé avec succès');
exit;
