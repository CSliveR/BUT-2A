<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerType;
use App\Repository\CommandeRepository;
use App\Repository\UsagerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/{_locale}/usager',
    requirements: ['_locale' => '%app.supported_locales%']
)]
final class UsagerController extends AbstractController
{
    #[Route(
        path:'/',
        name: 'app_usager_index',
        methods: ['GET']
    )]
    public function index(UsagerRepository $usagerRepository): Response
    {
        $user = $this->getUser();
        $usager = $usagerRepository->find($user->getId());

        return $this->render('usager/index.html.twig', [
            "email" => $usager->getEmail(),
            "prenom" => $usager->getPrenom(),
            "nom" =>  $usager->getNom(),
            "nbCommandes" => count($usager->getCommandes()),
        ]);
    }

    #[Route(
        path: '/new',
        name: 'app_usager_new',
        methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $usager = new Usager();
        $form = $this->createForm(UsagerType::class, $usager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encoder le mot de passe qui est en clair pour l’instant
            $hashedPassword = $passwordHasher->hashPassword($usager, $usager->getPassword());
            $usager->setPassword($hashedPassword);
            // Définir le rôle de l’usager qui va être créé
            $usager->setRoles(["ROLE_CLIENT"]);
            //Persister et enregistrer en base
            $entityManager->persist($usager);
            $entityManager->flush();

            return $this->redirectToRoute('app_usager_index',
                ['usager' => $usager, 'form' => $form,], Response::HTTP_SEE_OTHER);
        }

        return $this->render('usager/new.html.twig', [
            'usager' => $usager,
            'form' => $form,
        ]);
    }
    #[Route(
        path: '/commandes',
        name: 'app_usager_commandes')]
    public function commandes(UsagerRepository $usagerRepository): Response{
        $user = $this->getUser();
        $usager = $usagerRepository->find($user->getId());
        dump($usager->getCommandes()->toArray());
        return $this->render('usager/commandes.html.twig', [
            "nbCommandes" => count($usager->getCommandes()),
            "commandes" => $usager->getCommandes(),

        ]);
    }
    #[Route(
        path: '/commande/{idCommande}',
        name: 'app_usager_commande',
        requirements: ['idCommande' => '\d+'])]
    public function commande(CommandeRepository $commandeRepository, int $idCommande): Response{
        // Récupérer la commande correspondant à l'ID
        $commande = $commandeRepository->find($idCommande);

        return $this->render('usager/commande.html.twig', [
            "commande" => $commande,
            "idCommande" => $commande->getId(),
            "dateCommande" => $commande->getDateCreation(),
            "ligneCommandes" => $commande->getLigneCommandes(),
        ]);
    }

}
