<?php
namespace App\Service;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Usager;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
// Service pour manipuler le panier et le stocker en session
class PanierService
{
    ////////////////////////////////////////////////////////////////////////////
    private $session;   // Le service session
    //private $boutique;  // Le service boutique
    private $produitRepository;
    private $panier;    // Tableau associatif, la clé est un idProduit, la valeur associée est une quantité
                        // donc $this->panier[$idProduit] = quantité du produit dont l'id = $idProduit
    const PANIER_SESSION = 'panier'; // Le nom de la variable de session pour faire persister $this->panier

    // Constructeur du service
    public function __construct(RequestStack $requestStack, ProduitRepository $produitRepository)
    {
        // Récupération des services session et BoutiqueService
        $this->produitRepository = $produitRepository;
        $this->session = $requestStack->getSession();
        // Récupération du panier en session s'il existe, init. à vide sinon
        /* A COMPLETER */
        $this->panier = $this->session->get(self::PANIER_SESSION, array());
    }

    // Renvoie le montant total du panier
    public function getTotal() : float
    {
      /* A COMPLETER */
        $total = 0;
        foreach ($this->panier as $idProduit => $quantite) {
            $produit = $this->produitRepository->find($idProduit);
            if($produit){ //$produit != null
                $total += $produit->getPrix() * $quantite;
            }
        }
        return $total;
    }

    // Renvoie le nombre de produits dans le panier
    public function getNombreProduits() : int
    {
      /* A COMPLETER */
        return array_sum($this->panier);
    }

    // Ajouter au panier le produit $idProduit en quantite $quantite
    public function ajouterProduit(int $idProduit, int $quantite = 1) : void
    {
        /* A COMPLETER */
        if(isset($this->panier[$idProduit])){
            $this->panier[$idProduit] += $quantite;
        }else{
            $this->panier[$idProduit] = $quantite;
        }
        $this->mettreAJourPanier();
    }

    // Enlever du panier le produit $idProduit en quantite $quantite
    public function enleverProduit(int $idProduit, int $quantite = 1) : void
    {
      /* A COMPLETER */
        if(isset($this->panier[$idProduit]) && $this->panier[$idProduit] > $quantite){
            $this->panier[$idProduit] -= $quantite;
        }else{
            unset($this->panier[$idProduit]);
        }
        $this->mettreAJourPanier();
    }

    // Supprimer le produit $idProduit du panier
    public function supprimerProduit(int $idProduit) : void
    {
      /* A COMPLETER */
        unset($this->panier[$idProduit]);
        $this->mettreAJourPanier();
    }

    // Vider complètement le panier
    public function vider() : void
    {
      /* A COMPLETER */
        $this->panier = [];
        $this->mettreAJourPanier();
    }
    private function mettreAJourPanier() : void
    {
        $this->session->set(self::PANIER_SESSION, $this->panier);
    }

    // Renvoie le contenu du panier dans le but de l'afficher
    //   => un tableau d'éléments [ "produit" => un objet produit, "quantite" => sa quantite ]
    public function getContenu() : array
    {
      /* A COMPLETER */
        $tab = [];

        if(empty($this->panier)){
            return [];
        }

        foreach ($this->panier as $idProduit => $quantite){
            $produit = $this->produitRepository->find($idProduit);
            if($produit){
                $tab[] = [
                    "produit" => $produit,
                    "quantite" => $quantite
                ];
            }
        }
        return $tab;
    }

    public function panierToCommande(Usager $usager, EntityManagerInterface $entityManager) : ?Commande
    {
        $listItemsPanier = $this->getContenu();

        $commande = new Commande();
        $commande->setUsager($usager);
        $commande->setDateCreation(new \DateTime());
        $commande->setValidation(false);

        foreach ($listItemsPanier as $itemPanier){
            $ligneCommande = new LigneCommande();
            $ligneCommande->setProduit($itemPanier["produit"]);
            $ligneCommande->setQuantite($itemPanier["quantite"]);
            $ligneCommande->setPrix($itemPanier["produit"]->getPrix() * $itemPanier["quantite"]);
            $ligneCommande->setCommande($commande);
            $commande->addLigneCommande($ligneCommande);
            $entityManager->persist($ligneCommande);
        }

        //Sauvegarde en base de données
        $entityManager->persist($commande);
        $entityManager->flush();

        $this->vider();

        return $commande;
    }

}

