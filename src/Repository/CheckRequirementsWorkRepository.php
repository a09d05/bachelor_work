<?php

namespace App\Repository;

use App\Entity\CheckRequirementsWork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CheckRequirementsWork>
 *
 * @method CheckRequirementsWork|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckRequirementsWork|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckRequirementsWork[]    findAll()
 * @method CheckRequirementsWork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckRequirementsWorkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckRequirementsWork::class);
    }

//    /**
//     * @return CheckRequirementsWork[] Returns an array of CheckRequirementsWork objects
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

//    public function findOneBySomeField($value): ?CheckRequirementsWork
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
