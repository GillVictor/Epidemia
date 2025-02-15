namespace App\Controller;

use App\Repository\PaysRepository;
use App\Repository\VilleRepository;
use App\Repository\PointSurveillanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(
        PaysRepository $paysRepository, 
        VilleRepository $villeRepository, 
        PointSurveillanceRepository $pointSurveillanceRepository
    ): Response {
        $totalPays = $paysRepository->countAll();
        $totalVilles = $villeRepository->countAll();
        $totalPointsSurveillance = $pointSurveillanceRepository->countAll();

        return $this->render('dashboard.html.twig', [
            'totalPays' => $totalPays,
            'totalVilles' => $totalVilles,
            'totalPointsSurveillance' => $totalPointsSurveillance
        ]);
    }
}



<div class="col-12">
    <div class="card top-selling overflow-auto">
        <div class="card-body pb-0">
            <h5 class="card-title">Tableau de Bord<span>&nbsp;| Actuellement</span></h5>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de Pays</h5>
                            <p class="card-text"><?= $totalPays; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de Villes</h5>
                            <p class="card-text"><?= $totalVilles; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de Points de Surveillance</h5>
                            <p class="card-text"><?= $totalPointsSurveillance; ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

