<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;


#[Route(
    path: '/{_locale}/boutique',
    requirements: ['_locale' => '%app.supported_locales%']
)]
final class BoutiqueController extends AbstractController
{
    #[Route(
        path: '/',
        name: 'app_boutique'
    )]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        return $this->render('boutique/index.html.twig', [
            "categories" => $categories,
        ]);
    }

    #[Route(
        path: '/rayon/{idCategorie}',
        name: 'app_boutique_rayon',
        requirements: ['idCategorie' => '\d+']
    )]
    public function rayon(CategorieRepository $categorieRepository, ProduitRepository $produitRepository, int $idCategorie): Response
    {
        $categorie = $categorieRepository->find($idCategorie);
        $produits = $produitRepository->findBy(['categorie' => $categorie]);
        return $this->render('boutique/rayon.html.twig', [
            "categorie" => $categorie,
            "produits" => $produits
        ]);
    }

    #[Route(
        path: '/chercher/{recherche}',
        name: 'app_boutique_chercher',
        requirements: ['recherche' => '.+'], // regexp pour avoir tous les car, / compris
        defaults: ['recherche' => ''])
    ]
    public function chercher(ProduitRepository $produitRepository, string $recherche): Response
    {
        $searchString = urldecode($recherche);
        $produitsTrouves = $produitRepository->findProduitsByLibelleOrTexte($searchString);
        $nombreProduit = count($produitsTrouves);

        return $this->render('boutique/chercher.html.twig', [
            'searchString' => $searchString,
            'produits' => $produitsTrouves,
            'nombreProduit' => $nombreProduit,
        ]);
    }

    public function topVentes(ProduitRepository $produitRepository): Response
    {
        $prodPlusVendus = $produitRepository->nProduitsLesPlusVendus(5);

        return $this->render('boutique/topVentes.html.twig', [
            'prodPlusVendus' => $prodPlusVendus,
        ]);
    }

    #[Route(
        path: '/detailsProduit/{idProduit}',
        name: 'app_boutique_detailsProduit',
        requirements: ['idProduit' => '\d+']
    )]
    public function detailsProduit(ProduitRepository $produitRepository, int $idProduit): Response
    {
        $produit = $produitRepository->find($idProduit);
        return $this->render('boutique/detailsProduit.html.twig', [
            "idProduit" => $idProduit,
            "produit" => $produit,
        ]);
    }
}




/*
namespace App\Controller;

use App\Service\BoutiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/{_locale}/boutique',
    requirements: ['_locale' => '%app.supported_locales%']
)]
final class BoutiqueController extends AbstractController
{
    #[Route(
        path: '/',
        name: 'app_boutique'
    )]
    public function index(BoutiqueService $boutiqueService): Response
    {
        $categories = $boutiqueService->findAllCategories();
        return $this->render('boutique/index.html.twig', [
            "categories" => $categories,
        ]);
    }

    #[Route(
        path: '/rayon/{idCategorie}',
        name: 'app_boutique_rayon',
        requirements: ['idCategorie' => '\d+']
    )]
    public function rayon(BoutiqueService $boutiqueService, int $idCategorie): Response
    {
        $categorie = $boutiqueService->findCategorieById($idCategorie);
        $produits = $boutiqueService->findProduitsByCategorie($idCategorie);
        return $this->render('boutique/rayon.html.twig', [
            "categorie" => $categorie,
            "produits" => $produits
        ]);
    }

    #[Route(
        path: '/chercher/{recherche}',
        name: 'app_boutique_chercher',
        requirements: ['recherche' => '.+'], // regexp pour avoir tous les car, / compris
        defaults: ['recherche' => ''])
    ]
    public function chercher(BoutiqueService $boutiqueService, string $recherche): Response
    {
        $searchString = urldecode($recherche);
        $produitsTrouves = $boutiqueService->findProduitsByLibelleOrTexte($searchString);
        $nombreProduit = count($produitsTrouves);

        return $this->render('boutique/chercher.html.twig', [
            'searchString' => $searchString,
            'produits' => $produitsTrouves,
            'nombreProduit' => $nombreProduit,

        ]);
    }
}*/
