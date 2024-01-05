<?php

namespace App\Repository;

use App\Entity\Due;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Due>
 *
 * @method Due|null find($id, $lockMode = null, $lockVersion = null)
 * @method Due|null findOneBy(array $criteria, array $orderBy = null)
 * @method Due[]    findAll()
 * @method Due[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Due::class);
    }

//    /**
//     * @return Due[] Returns an array of Due objects
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
    public function findByFiltre($filtre): array
    {
        $query = $this->createQueryBuilder('d')           
            ->orderBy('d.creatAt', 'DESC');
        if(!empty($filtre['dateFiltreDue'])){
            $query->andWhere('d.creatAt like :date')
                    ->setParameter('date','%'.$filtre['dateFiltreDue'].'%');
        }
        if(!empty($filtre['dateFiltreClient'])){
            $query->andWhere('d.client like :client')
                    ->setParameter("client",'%'.$filtre['dateFiltreClient'].'%');
        }  
        return $query->getQuery()
                    ->getResult();

    }
    public function totalFiltre($filtre)
    {
        $query = $this->createQueryBuilder("d")
                ->select('SUM(d.montantRestant)');
        if(!empty($filtre['dateFiltreDue'])){
            $query->andWhere('d.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['dateFiltreDue'].'%');
        }  
        if(!empty($filtre['dateFiltreClient'])){
            $query->andWhere('d.client like :client')
                    ->setParameter("client",'%'.$filtre['dateFiltreClient'].'%');
        }   
        return $query->getQuery()
                    ->getSingleScalarResult();

    }
    public function findTotalDate($filtre)
    {
        $query = $this ->createQueryBuilder("d")
                ->select('SUM(d.montantTotal - d.montantRestant)');                       
        if(!empty($filtre['inputFiltredateVente'])){
            $query->andWhere('d.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
        } 
        return $query->getQuery()
                    ->getSingleScalarResult();

    } 
//    public function findOneBySomeField($value): ?Due
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
