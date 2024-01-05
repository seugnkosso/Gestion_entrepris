<?php

namespace App\Repository;

use App\Entity\DD;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DD>
 *
 * @method DD|null find($id, $lockMode = null, $lockVersion = null)
 * @method DD|null findOneBy(array $criteria, array $orderBy = null)
 * @method DD[]    findAll()
 * @method DD[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DDRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DD::class);
    }

//    /**
//     * @return DD[] Returns an array of DD objects
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

//    public function findOneBySomeField($value): ?DD
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
