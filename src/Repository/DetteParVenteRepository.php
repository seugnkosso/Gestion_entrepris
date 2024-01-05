<?php

namespace App\Repository;

use App\Entity\DetteParVente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetteParVente>
 *
 * @method DetteParVente|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetteParVente|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetteParVente[]    findAll()
 * @method DetteParVente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetteParVenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetteParVente::class);
    }

//    /**
//     * @return DetteParVente[] Returns an array of DetteParVente objects
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

    public function findTotalDatedette($date)
    {
        $query = $this ->createQueryBuilder("d")
                ->select('SUM(d.benefice)');                       
        if(!empty($date)){
            $query->andWhere('d.creatAt like :date')
                    ->setParameter('date', '%'.$date.'%');
        } 
        return $query->getQuery()
                    ->getSingleScalarResult();
    }
    
    // public function findtotalDateDonneeSubBenef($filtre)
    // {
    //     $query = $this->createQueryBuilder("d")
    //         ->leftjoin("d.payements", "p")           
    //         ->select('d.benefice')
    //         ->where('d.montantDonnee > d.benefice');
    //     if(!empty($filtre['dateFiltreDue'])){
    //         $query->andWhere('p.creatAt like :date')
    //                 ->setParameter('date', '%'.$filtre['dateFiltreDue'].'%');
    //     }          
    //     return $query->getQuery()                    
    //                 ->getScalarResult();
    // }

//    public function findOneBySomeField($value): ?DetteParVente
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
