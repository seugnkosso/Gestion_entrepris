<?php

namespace App\Repository;

use App\Entity\VC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VC>
 *
 * @method VC|null find($id, $lockMode = null, $lockVersion = null)
 * @method VC|null findOneBy(array $criteria, array $orderBy = null)
 * @method VC[]    findAll()
 * @method VC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VCRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VC::class);
    }

//    /**
//     * @return VC[] Returns an array of VC objects
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

//    public function findOneBySomeField($value): ?VC
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
