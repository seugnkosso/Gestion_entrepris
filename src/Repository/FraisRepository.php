<?php

namespace App\Repository;

use App\Entity\Frais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Frais>
 *
 * @method Frais|null find($id, $lockMode = null, $lockVersion = null)
 * @method Frais|null findOneBy(array $criteria, array $orderBy = null)
 * @method Frais[]    findAll()
 * @method Frais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FraisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Frais::class);
    }

//    /**
//     * @return Frais[] Returns an array of Frais objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findByFiltre($filtre): array
    {
        $query = $this->createQueryBuilder('f')
            ->join('f.point','p')
            ->orderBy('f.creatAt', 'DESC')
            ->where('p.id = :point_id')
            ->setParameter('point_id', $filtre['pointId']);            
        if(!empty($filtre['selectFiltreDate'])){
            $query->andWhere('f.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['selectFiltreDate'].'%');
        } 
        return $query->getQuery()
                    ->getResult();

    }
    public function totalFiltre($filtre)
    {
        $query = $this->createQueryBuilder("f")
                ->join('f.point','p')
                ->select('SUM(f.montant)')
                ->where('p.id = :point_id')
                ->setParameter('point_id', $filtre['pointId']);                
        if(!empty($filtre['selectFiltreDate'])){
            $query->andWhere('f.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['selectFiltreDate'].'%');
        } 
        return $query->getQuery()
                    ->getSingleScalarResult();

    }

         public function findTotalDate($filtre)
        {
            $query = $this ->createQueryBuilder("f")            
                    ->join('f.point','p')
                    ->select('SUM(f.montant)')
                    ->where('p.id = :point_id')
                    ->setParameter('point_id', $filtre['pointId']);
            if(!empty($filtre['inputFiltredateVente'])){
                $query->andWhere('f.creatAt like :date')
                        ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
            }
            return $query->getQuery()
                        ->getSingleScalarResult();

        }

        public function findAllDay($date,$idPoint)
        {
            return $this->createQueryBuilder('f')            
                    ->join('f.point','p')
                    ->select("SUM(f.montant)")
                    ->where('p.id = :point_id')
                    ->setParameter('point_id', $idPoint)
                    ->andwhere("f.creatAt like :date")
                    ->setParameter("date",'%'.$date.'%')
                    ->getQuery()
                    ->getSingleScalarResult();

        }

//    public function findOneBySomeField($value): ?Frais
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
