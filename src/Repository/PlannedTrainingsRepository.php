<?php

namespace App\Repository;

use App\Entity\PlannedTrainings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlannedTrainings>
 *
 * @method PlannedTrainings|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlannedTrainings|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlannedTrainings[]    findAll()
 * @method PlannedTrainings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlannedTrainingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlannedTrainings::class);
    }

//    /**
//     * @return PlannedTrainings[] Returns an array of PlannedTrainings objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlannedTrainings
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
