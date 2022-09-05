<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    #[Route(path: [
        'en' => '/privacy-policy',
        'de' => '/datenschutz-bestimmungen',
        'es' => '/política-de-privacidad',
        'fr' => '/politique-de-confidentialite',
        'it' => '/politica-sulla-riservatezza',
    ], name: 'app_privacy')]
    public function privacy(): Response
    {
        return $this->render('legal/privacy.html.twig');
    }

    #[Route(path: [
        'en' => '/general-terms-and-conditions-of-use',
        'de' => '/allgemeine-nutzungsbedingungen',
        'es' => '/condiciones-generales-de-uso',
        'fr' => '/conditions-generales-utilisation',
        'it' => '/termini-e-condizioni-generali-di-utilizzo',
    ], name: 'app_terms')]
    public function terms(): Response
    {
        return $this->render('legal/terms.html.twig');
    }
}
