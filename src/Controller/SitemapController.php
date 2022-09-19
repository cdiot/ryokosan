<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/site-map.xml', name: 'app_site_map', defaults: [
        '_format' => 'xml',
    ])]
    public function index(Request $request): Response
    {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

        $urls[] = [
            'en' => $this->generateUrl('app_home', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_home', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_home', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_home', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_home', ['_locale' => 'it']),
        ];
        $urls[] = [
            'en' => $this->generateUrl('app_login', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_login', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_login', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_login', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_login', ['_locale' => 'it']),
        ];
        $urls[] = [
            'en' => $this->generateUrl('app_register', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_register', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_register', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_register', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_register', ['_locale' => 'it']),
        ];
        $urls[] = [
            'en' => $this->generateUrl('app_forgot_password_request', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_forgot_password_request', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_forgot_password_request', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_forgot_password_request', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_forgot_password_request', ['_locale' => 'it']),
        ];
        $urls[] = [
            'en' => $this->generateUrl('app_activity_index', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_activity_index', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_activity_index', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_activity_index', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_activity_index', ['_locale' => 'it']),
        ];
        $urls[] = [
            'en' => $this->generateUrl('app_activity_new', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_activity_new', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_activity_new', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_activity_new', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_activity_new', ['_locale' => 'it']),
        ];
        $urls[] = [
            'en' => $this->generateUrl('app_newsletter', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_newsletter', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_newsletter', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_newsletter', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_newsletter', ['_locale' => 'it']),
        ];
        $urls[] = [
            'en' => $this->generateUrl('app_contact', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_contact', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_contact', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_contact', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_contact', ['_locale' => 'it']),
        ];
        $urls[] = [
            'en' => $this->generateUrl('app_privacy', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_privacy', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_privacy', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_privacy', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_privacy', ['_locale' => 'it']),
        ];
        $urls[] = [
            'en' => $this->generateUrl('app_terms', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_terms', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_terms', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_terms', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_terms', ['_locale' => 'it']),
        ];

        $response = new Response(
            $this->renderView(
                'sitemap/index.html.twig',
                [
                    'urls' => $urls,
                    'hostname' => $hostname
                ]
            )
        );
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
