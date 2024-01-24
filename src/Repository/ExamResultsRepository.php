<?php

namespace App\Repository;

use App\Entity\ExamResults;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExamResults>
 *
 * @method ExamResults|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamResults|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamResults[]    findAll()
 * @method ExamResults[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamResultsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamResults::class);
    }

//    /**
//     * @return ExamResults[] Returns an array of ExamResults objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExamResults
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
