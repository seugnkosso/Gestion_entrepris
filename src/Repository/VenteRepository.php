<?php

namespace App\Repository;

use App\Entity\Vente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vente>
 *
 * @method Vente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vente[]    findAll()
 * @method Vente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vente::class);
    }

//    /**
//     * @return Vente[] Returns an array of Vente objects
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
                ->join('v.point','p')
                ->OrderBy("v.creatAt","DESC")
                ->where("v.total > 0")
                ->andWhere('p.id = :point_id')
                ->setParameter('point_id', $filtre['pointId']);
            if(!empty($filtre['inputFiltreClientVente'])){
                $query->andWhere('v.client like :client')
                        ->setParameter('client', '%'.$filtre['inputFiltreClientVente'].'%');
            }
            if(!empty($filtre['inputFiltreUserVente'])){
                $query->join("v.user", "u")
                        ->andWhere('u.nomComplet like :users or u.telephone like :users or u.email like :users')
                        ->setParameter('users', '%'.$filtre['inputFiltreUserVente'].'%');
            }

            if(!empty($filtre['inputFiltredateVente'])){
                $query->andWhere('v.creatAt like :date')
                        ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
            }
            return $query->getQuery()
                        ->getResult();

        }
        public function findAllDay($date,$idPoint)
        {
            $query = $this->createQueryBuilder('v')
                ->join('v.point','p')
                ->select("SUM(v.total)")
                ->where('p.id = :point_id')
                ->setParameter('point_id', $idPoint)
                ->where("v.creatAt like :date")
                ->setParameter("date",'%'.$date.'%');
                return $query->getQuery()
                            ->getSingleScalarResult();

        }

        public function findByFiltreTotal($filtre)
        {
            $query = $this ->createQueryBuilder("v")
                    ->join('v.point','p')
                    ->select('SUM(v.total)')
                    ->andWhere("v.total > 0")
                    ->andwhere('p.id like :point_id')
                    ->setParameter('point_id', $filtre['pointId']);
            if(!empty($filtre['inputFiltreClientVente'])){
                $query->andWhere('v.client like :client')
                        ->setParameter('client', '%'.$filtre['inputFiltreClientVente'].'%');
            } 
            if(!empty($filtre['inputFiltreUserVente'])){
                $query->join("v.user", "u")
                        ->andWhere('u.nomComplet like :users or u.telephone like :users or u.email like :users')
                        ->setParameter('users', '%'.$filtre['inputFiltreUserVente'].'%');
            } 

            if(!empty($filtre['inputFiltredateVente'])){
                $query->andWhere('v.creatAt like :date')
                        ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
            } 
            return $query->getQuery()
                        ->getSingleScalarResult();

        }

        public function findTotalDate($filtre)
        {
            $query = $this ->createQueryBuilder("v")
                    ->join("v.detailVc", "d")
                    ->join("d.produit", "p")
                    ->join('v.point','po')
                    ->select('SUM(d.prixVente * d.qteVente) - SUM(p.prixAchat * d.qteVente)')
                    ->where("v.total > 0")
                    ->andwhere('po.id = :point_id')
                    ->setParameter('point_id', $filtre['pointId']);
            if(!empty($filtre['inputFiltredateVente'])){
                $query->andWhere('v.creatAt like :date')
                        ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
            } 
            return $query->getQuery()
                        ->getSingleScalarResult();

        }
//    public function findOneBySomeField($value): ?Vente
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
