<?php

namespace App\Repository;

use App\Entity\Vendeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vendeur>
 *
 * @method Vendeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vendeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vendeur[]    findAll()
 * @method Vendeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vendeur::class);
    }

//    /**
//     * @return Vendeur[] Returns an array of Vendeur objects
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
public function findByFiltre($filtre): array
{
    $query = $this->createQueryBuilder('v')                
                ->join('v.points','p')
                ->where('p.id = :point_id')
                ->setParameter('point_id', $filtre['pointId']);

    if(!empty($filtre['inputUserFiltre'])){
        $query->andWhere('v.nomComplet like :user or v.telephone like :user')
                ->setParameter('user', '%'.$filtre['inputUserFiltre'].'%');
    } 
    return $query->getQuery()
                ->getResult();
}
//    public function findOneBySomeField($value): ?Vendeur
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
