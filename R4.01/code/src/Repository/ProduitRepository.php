<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
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

    //    public function findOneBySomeField($value): ?Produit
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * Recherche les produits contenant un mot-clé dans le libellé ou le texte
     */
    public function findProduitsByLibelleOrTexte(string $recherche): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.libelle LIKE :search')
            ->orWhere('p.texte LIKE :search')
            ->setParameter('search', '%'.$recherche.'%')
            ->getQuery()
            ->getResult();
    }

    public function nProduitsLesPlusVendus(int $n): array
    {
        return $this->createQueryBuilder('p')
            ->select('p as produit, SUM(lc.quantite) as totalVentes')
            ->join('p.ligneCommandes', 'lc') // Joindre les lignes de commande
            ->groupBy('p.id') // Grouper par produit
            ->orderBy('totalVentes', 'DESC') // Trier par ventes décroissantes
            ->setMaxResults($n) // Limiter à n résultats
            ->getQuery()
            ->getResult();
    }
}
