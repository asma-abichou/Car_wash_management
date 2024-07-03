<?php

namespace App\Repository;

use App\Entity\CarWashPoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarWashPoint>
 */
class CarWashPointRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarWashPoint::class);
    }
  public function findNearby($lat, $lon)
    {
        // Here you can use a custom query to find nearby car wash points
        $qb = $this->createQueryBuilder('c')
            ->where('ST_Distance_Sphere(point(c.longitude, c.latitude), point(:lon, :lat)) <= :distance')
            ->setParameter('lat', $lat)
            ->setParameter('lon', $lon)
            ->setParameter('distance', 5000) // example: find within 5km radius
            ->getQuery();

        return $qb->getResult();
    }

//    /**
//     * @return CarWashPoint[] Returns an array of CarWashPoint objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarWashPoint
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
