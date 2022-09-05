<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route(path: [
        'en' => '/about',
        'de' => '/um',
        'es' => '/a-proposito',
        'fr' => '/a-propos',
        'it' => '/di',
    ], name: 'app_about')]
    public function index(): Response
    {
        return $this->render('about/index.html.twig');
    }
}
