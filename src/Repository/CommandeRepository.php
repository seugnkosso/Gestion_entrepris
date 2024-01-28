<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

//    /**
//     * @return Commande[] Returns an array of Commande objects
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
                    ->orderBy("c.creatAt","DESC")                    
                    ->andwhere('p.id like :point_id')
                    ->setParameter('point_id', $filtre['pointId']);
            if(!empty($filtre['inputFiltreClientVente'])){
                $query->andWhere('c.client like :client')
                        ->setParameter('client', '%'.$filtre['inputFiltreClientVente'].'%');
            } 
            if(!empty($filtre['inputFiltreUserVente'])){
                $query->join("c.user", "u")
                        ->andWhere('u.nomComplet like :users or u.telephone like :users or u.email like :users')
                        ->setParameter('users', '%'.$filtre['inputFiltreUserVente'].'%');
            } 

            if(!empty($filtre['inputFiltredateVente'])){
                $query->andWhere('c.creatAt like :date')
                        ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
            } 
            return $query->getQuery()
                        ->getResult();
        }

        public function findByFiltreTotal($filtre)
        {
            $query = $this ->createQueryBuilder("c")
                    ->join('c.point','p')
                    ->select('SUM(c.total)')
                    ->andwhere('p.id like :point_id')
                    ->setParameter('point_id', $filtre['pointId']);
            if(!empty($filtre['inputFiltreClientVente'])){
                $query->andWhere('c.client like :client')
                        ->setParameter('client', '%'.$filtre['inputFiltreClientVente'].'%');
            } 
            if(!empty($filtre['inputFiltreUserVente'])){
                $query->join("c.user", "u")
                        ->andWhere('u.nomComplet like :users or u.telephone like :users or u.email like :users')
                        ->setParameter('users', '%'.$filtre['inputFiltreUserVente'].'%');
            } 

            if(!empty($filtre['inputFiltredateVente'])){
                $query->andWhere('c.creatAt like :date')
                        ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
            } 
            return $query->getQuery()
                        ->getSingleScalarResult();

        }

        public function findAllDay($date,$idPoint)
        {
            $query = $this->createQueryBuilder('c')
                ->join('c.point','p')
                ->select("SUM(c.total)")
                ->where("c.creatAt like :date")
                ->setParameter("date",'%'.$date.'%')
                ->andwhere('p.id like :point_id')
                ->setParameter('point_id', $idPoint);
                return $query->getQuery()
                            ->getSingleScalarResult();
        }
//    public function findOneBySomeField($value): ?Commande
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
