<?php

namespace App\Repository;

use App\Entity\ViolationsRulesSafe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ViolationsRulesSafe>
 *
 * @method ViolationsRulesSafe|null find($id, $lockMode = null, $lockVersion = null)
 * @method ViolationsRulesSafe|null findOneBy(array $criteria, array $orderBy = null)
 * @method ViolationsRulesSafe[]    findAll()
 * @method ViolationsRulesSafe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViolationsRulesSafeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ViolationsRulesSafe::class);
    }

//    /**
//     * @return ViolationsRulesSafe[] Returns an array of ViolationsRulesSafe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ViolationsRulesSafe
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
