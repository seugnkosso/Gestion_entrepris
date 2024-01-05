<?php

namespace App\Repository;

use App\Entity\Dette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dette>
 *
 * @method Dette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dette[]    findAll()
 * @method Dette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dette::class);
    }

//    /**
//     * @return Dette[] Returns an array of Dette objects
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
                    ->setParameter('date', '%'.$filtre['dateFiltreDue'].'%');
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
                ->select('SUM(d.montantTotal - d.montantDonnee)');                       
        if(!empty($filtre['inputFiltredateVente'])){
            $query->andWhere('d.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
        } 
        return $query->getQuery()
                    ->getSingleScalarResult();

    }    

        
//    public function findOneBySomeField($value): ?Dette
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
