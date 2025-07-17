<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route(
        path: '/{_locale}/',
        name: 'app_default_index',
        requirements: ['_locale' => '%app.supported_locales%'],
        //defaults: ['_locale' => '%default_locale%']
    )]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    // TODO : route et contrôleur de la page de contact
    #[Route(
        path: '/{_locale}/contact',
        name: 'app_default_contact',
        requirements: ['_locale' => '%app.supported_locales%'],
    )]
     public function contact(): Response
     {
         return $this->render('default/contact.html.twig');
     }
}
