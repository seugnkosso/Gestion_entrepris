<?php

namespace App\Repository;

use App\Entity\DetailVC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailVC>
 *
 * @method DetailVC|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailVC|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailVC[]    findAll()
 * @method DetailVC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailVCRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailVC::class);
    }

//    /**
//     * @return DetailVC[] Returns an array of DetailVC objects
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

//    public function findOneBySomeField($value): ?DetailVC
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
