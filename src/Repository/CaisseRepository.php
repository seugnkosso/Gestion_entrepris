<?php

namespace App\Repository;

use App\Entity\Caisse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Caisse>
 *
 * @method Caisse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caisse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caisse[]    findAll()
 * @method Caisse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaisseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caisse::class);
    }

//    /**
//     * @return Caisse[] Returns an array of Caisse objects
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
    public function findByFiltre($filtre): array
    {
        $query = $this->createQueryBuilder('c')
                ->join('c.point','p')
                ->orderBy("c.CreatAt","DESC")
                ->andwhere('p.id like :point_id')
                ->setParameter('point_id', $filtre['pointId']);

        if(!empty($filtre['inputFiltreCaisse'])){
            $query->andWhere('c.CreatAt like :date')
                    ->setParameter('date', '%'.$filtre['inputFiltreCaisse'].'%');
        }
        return $query->getQuery()
                    ->getResult();
    }

    public function findByDate($date,$idPoint): array
    {
        $query = $this->createQueryBuilder('c')
                ->join('c.point','p')
                ->select("SUM(c.TotalFrais) as totalFrais, SUM(c.totalVente) as totalVente, SUM(c.totalDettePayer) as totalDettePayer, SUM(c.TotalDusPayer) as TotalDusPayer, SUM(c.TotalCommande) as TotalCommande, SUM(c.benefice) as benefice")
                ->andwhere('p.id like :point_id')
                ->setParameter('point_id', $idPoint);
                if(!empty($date)){
                    $query->andWhere('c.CreatAt like :date')
                            ->setParameter('date', '%'.$date.'%');
                }
        return $query->getQuery()
                    ->getOneOrNullResult();
    }
//    public function findOneBySomeField($value): ?Caisse
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
