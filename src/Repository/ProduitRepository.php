<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

//    /**
//     * @return Produit[] Returns an array of Produit objects
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
    public function findByFiltre($filtre): array
    {
        $query = $this->createQueryBuilder('p')           
            ->orderBy('p.qte', 'DESC');
            
        if(!empty($filtre['qteFiltreManque'])){
            $query->andWhere('p.qte < :qteFiltreManque')
                    ->setParameter('qteFiltreManque', $filtre['qteFiltreManque']);
        }     
        if(!empty($filtre['qteFiltreExiste'])){
            $query->andWhere('p.qte > :qteFiltreExiste')
                    ->setParameter('qteFiltreExiste', $filtre['qteFiltreExiste']);
        }     
        if(!empty($filtre['inputFiltreProduit'])){
            $query->andWhere('p.categorie like :prod or p.detail like :prod')
                    ->setParameter('prod', '%'.$filtre['inputFiltreProduit'].'%');
        } 
        return $query->getQuery()
                    ->getResult();

    }

    public function findByFiltreVente($filtre): array
    {
        $query = $this->createQueryBuilder('p')           
            ->orderBy('p.qte', 'DESC')
            ->where("p.qte > 0");
            
        if(!empty($filtre['qteFiltreManque'])){
            $query->andWhere('p.qte < :qteFiltreManque')
                    ->setParameter('qteFiltreManque', $filtre['qteFiltreManque']);
        }     
        if(!empty($filtre['qteFiltreExiste'])){
            $query->andWhere('p.qte > :qteFiltreExiste')
                    ->setParameter('qteFiltreExiste', $filtre['qteFiltreExiste']);
        }     
        if(!empty($filtre['inputFiltreProduit'])){
            $query->andWhere('p.categorie like :prod or p.detail like :prod')
                    ->setParameter('prod', '%'.$filtre['inputFiltreProduit'].'%');
        } 
        return $query->getQuery()
                    ->getResult();

    }

    public function updateQte($qte,$id)
    {
        $query = $this->getEntityManager()->createQuery('UPDATE App\Entity\Produit p
            SET p.qte = :qte
            WHERE p.id = :id
        ');
        $query->setParameter("qte", $qte);
        $query->setParameter("id", $id);
        $query->execute();

    }
//    public function findOneBySomeField($value): ?Produit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
