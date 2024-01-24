<?php

namespace App\Repository;

use App\Entity\Depts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Depts>
 *
 * @method Depts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Depts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Depts[]    findAll()
 * @method Depts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeptsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Depts::class);
    }

//    /**
//     * @return Depts[] Returns an array of Depts objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Depts
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
