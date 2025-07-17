<?php

namespace App\Controller;

use App\Service\PanierService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '{_locale}/panier',
    requirements: ['_locale' => '%app.supported_locales%']
)]
final class PanierController extends AbstractController
{
    #[Route(
        path: '/',
        name: 'app_panier_index',
    )]
    public function index(PanierService $panierService): Response
    {
        return $this->render('panier/index.html.twig', [
            'nombreProduits' => $panierService->getNombreProduits(),
            'prixTotal' => $panierService->getTotal(),
            'contenuPanier' => $panierService->getContenu(),
        ]);
    }

    #[Route(
        path: '/ajouter/{idProduit}/{quantite}',
        name: 'app_panier_ajouter',
        requirements: ['idProduit' => '\d+', 'quantite' => '\d+']
    )]
    public function ajouter(PanierService $panierService, int $idProduit): Response
    {
        $panierService->ajouterProduit($idProduit);
        return $this->redirectToRoute('app_panier_index',[]);
    }
    #[Route(
        path: '/enlever/{idProduit}/{quantite}',
        name: 'app_panier_enlever',
        requirements: ['idProduit' => '\d+', 'quantite' => '\d+']
    )]
    public function enlever(PanierService $panierService, int $idProduit): Response
    {
        $panierService->enleverProduit($idProduit);
        return $this->redirectToRoute('app_panier_index',[]);
    }
    #[Route(
        path: '/supprimer/{idProduit}',
        name: 'app_panier_supprimer',
        requirements: ['idProduit' => '\d+']
    )]
    public function supprimer(PanierService $panierService, int $idProduit): Response
    {
        $panierService->supprimerProduit($idProduit);
        return $this->redirectToRoute('app_panier_index',[]);
    }
    #[Route(
        path: '/vider',
        name: 'app_panier_vider',
    )]
    public function vider(PanierService $panierService): Response
    {
        $panierService->vider();
        return $this->redirectToRoute('app_panier_index',[]);
    }

    public function nombreProduits(PanierService $panierService): Response{
        $nbProduits = $panierService->getNombreProduits();
        return $this->render('panier/nombreProduits.html.twig', ["nbProduits" => $nbProduits]);
    }
    #[Route(
        path: '/commander',
        name: 'app_panier_commander',
    )]
    public function commander(PanierService $panierService, EntityManagerInterface $entityManager): Response
    {
        $usager = $this->getUser();
        $commande = $panierService->panierToCommande($usager, $entityManager);

        return $this->render('panier/commande.html.twig', [
            "nomUsager" => $usager->getNom(),
            "prenomUsager" => $usager->getPrenom(),
            "idCommande" => $commande->getId(),
            "date" => $commande->getDateCreation(),
        ]);

        /*
                if (!$commande) {
            return $this->render('panier/commande.html.twig', [
            ]);
        }

        $montantCommande = 0;
        foreach ($commande->getLigneCommandes() as $ligneCommande) {
            $produit = $ligneCommande->getProduit();
            if ($produit) {
                $montantCommande += $produit->getPrix();
            }
        }
        return $this->render('panier/commande.html.twig', [
            "idCommande" => $commande->getId(),
            "nbCommandes" => count($commande->getLigneCommandes()),
            "montant" => $montantCommande,
            "date" => date('d-m-Y'),
            "heure" => date('H:i'),
        ]);*/
    }

}
