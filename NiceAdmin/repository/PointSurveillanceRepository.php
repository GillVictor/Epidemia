namespace App\Repository;

use App\Entity\PointSurveillance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PointSurveillanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PointSurveillance::class);
    }

    public function countAll(): int
    {
        return $this->createQueryBuilder('ps')
            ->select('COUNT(ps.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
