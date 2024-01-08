<?php

namespace App\Repository;

use App\Entity\Payement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Payement>
 *
 * @method Payement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payement[]    findAll()
 * @method Payement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PayementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payement::class);
    }

//    /**
//     * @return Payement[] Returns an array of Payement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
    public function findByFiltreDette($filtre): array
    {
        $query = $this->createQueryBuilder('p')         
            ->orderBy('p.creatAt', 'DESC')
            ->join("p.DD", "d")
            ->where('d.id = :idDette')
            ->setParameter("idDette",$filtre["idDette"]);
        if(!empty($filtre['dateFiltreDue'])){
            $query->andWhere('p.creatAt like :date')
                    ->setParameter('date','%'.$filtre['dateFiltreDue'].'%');
        }
        return $query->getQuery()
                    ->getResult();

    }

    public function totalFiltreDette($filtre)
    {
        $query = $this->createQueryBuilder("p")
            ->join("p.DD", "d")
            ->where('d.id = :idDette')
            ->setParameter("idDette",$filtre["idDette"])
            ->select('SUM(p.montantVerser)');
        if(!empty($filtre['dateFiltreDue'])){
            $query->andWhere('p.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['dateFiltreDue'].'%');
        }          
        return $query->getQuery()
                    ->getSingleScalarResult();

    }

    public function findtotalDateDonneeinfBenef($filtre)
    {
        $query = $this->createQueryBuilder("p")
            ->join("p.detteParVente", "d")            
            ->select('SUM(p.montantVerser)')
            ->where('d.montantDonnee <=  d.benefice');
        if(!empty($filtre['inputFiltredateVente'])){
            $query->andWhere('p.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
        }          
        return $query->getQuery()
                    ->getSingleScalarResult();
    }
    public function findtotalDateDonneeSubBenef($filtre)
    {
        $query = $this->createQueryBuilder("p")
            ->Join("p.detteParVente", "d")            
            // ->select('d.benefice,d.benefComplet')
            ->where('d.montantDonnee > d.benefice and d.montantRestant != 0');
        if(!empty($filtre['inputFiltredateVente'])){
            $query->andWhere('p.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
        }          
        return $query->getQuery() 
                    ->setMaxResults(1)                   
                    ->getResult();
    }

    public function findTotalPayFiltre($filtre)
    {
        $query = $this->createQueryBuilder("p")
            ->join("p.detteParVente","d")
            ->select('SUM(p.montantVerser)')
            ->where("d.montantDonnee <= d.benefice");
        if(!empty($filtre['inputFiltredateVente'])){
            $query->andWhere('p.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
        }          
        return $query->getQuery()
                    ->getSingleScalarResult();
    }
    public function findAllDayDette($date)
    {
        $query = $this->createQueryBuilder('p')
            ->join("p.DD","d")
            ->select("SUM(p.montantVerser)")
            ->where('d.typeDD = :detteParVente')
            ->setParameter("detteParVente",'detteParVe')
            ->andwhere("p.creatAt like :date")
            ->setParameter("date",'%'.$date.'%');
            return $query->getQuery()
                        ->getSingleScalarResult();

    }
    public function findAllDayDus($date)
    {
        $query = $this->createQueryBuilder('p')
            ->join("p.DD","d")
            ->select("SUM(p.montantVerser) - SUM(p.prixTotalVente)")
            ->where('d.typeDD = :dus')
            ->setParameter("dus",'dus');
            if(!empty($date)){
                $query = $query->andwhere("p.creatAt like :date")
                        ->setParameter("date",'%'.$date.'%');
            }
            return $query->getQuery()
                        ->getSingleScalarResult();

    }
    public function findbeneficeDonneeDay($date)
    {
        $query = $this->createQueryBuilder('p')
            ->join("p.detteParVente","d")
            ->select("SUM(p.montantVerser)")
            ->where("d.montantRestant != 0 and d.montantDonnee <= d.benefice")
            ->andwhere("p.creatAt like :date")
            ->setParameter("date",'%'.$date.'%');
            return $query->getQuery()
                        ->getSingleScalarResult();

    }

    public function findTotalPayFiltreSub($filtre)
    {
        $query = $this->createQueryBuilder("p")
            ->join("p.detteParVente","d")
            // ->select('d.benefice')
            ->where("d.montantDonnee > d.benefice and d.montantRestant != 0");
        if(!empty($filtre['inputFiltredateVente'])){
            $query->andWhere('p.creatAt like :date')
                    ->setParameter('date', '%'.$filtre['inputFiltredateVente'].'%');
        }          
        return $query->getQuery()
                    ->setMaxResults(1)
                    ->getResult();
    }
    
//    public function findOneBySomeField($value): ?Payement
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
