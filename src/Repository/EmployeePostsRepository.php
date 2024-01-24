<?php

namespace App\Repository;

use App\Entity\EmployeePosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployeePosts>
 *
 * @method EmployeePosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeePosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeePosts[]    findAll()
 * @method EmployeePosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeePostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeePosts::class);
    }

//    /**
//     * @return EmployeePosts[] Returns an array of EmployeePosts objects
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

//    public function findOneBySomeField($value): ?EmployeePosts
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
