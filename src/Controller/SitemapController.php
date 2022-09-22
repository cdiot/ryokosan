<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/site-map.xml', name: 'app_site_map', defaults: [
        '_format' => 'xml',
    ])]
    public function index(
        Request $request,
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository
    ): Response {
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
            'en' => $this->generateUrl('app_article_index', ['_locale' => 'en']),
            'de' => $this->generateUrl('app_article_index', ['_locale' => 'de']),
            'es' => $this->generateUrl('app_article_index', ['_locale' => 'es']),
            'fr' => $this->generateUrl('app_article_index', ['_locale' => 'fr']),
            'it' => $this->generateUrl('app_article_index', ['_locale' => 'it']),
        ];
        foreach ($articleRepository->findAll() as $article) {
            $urls[] = [
                'en' => $this->generateUrl('app_article_show', [
                    'slug' => $article->getSlug(),
                    '_locale' => 'en'
                ]),
                'de' => $this->generateUrl('app_article_show', [
                    'slug' => $article->getSlug(),
                    '_locale' => 'de'
                ]),
                'es' => $this->generateUrl('app_article_show', [
                    'slug' => $article->getSlug(),
                    '_locale' => 'es'
                ]),
                'fr' => $this->generateUrl('app_article_show', [
                    'slug' => $article->getSlug(),
                    '_locale' => 'fr'
                ]),
                'it' => $this->generateUrl('app_article_show', [
                    'slug' => $article->getSlug(),
                    '_locale' => 'it'
                ]),
            ];
        }
        foreach ($categoryRepository->findAll() as $category) {
            $urls[] = [
                'en' => $this->generateUrl('app_category_show', [
                    'slug' => $category->getSlug(),
                    '_locale' => 'en'
                ]),
                'de' => $this->generateUrl('app_category_show', [
                    'slug' => $category->getSlug(),
                    '_locale' => 'de'
                ]),
                'es' => $this->generateUrl('app_category_show', [
                    'slug' => $category->getSlug(),
                    '_locale' => 'es'
                ]),
                'fr' => $this->generateUrl('app_category_show', [
                    'slug' => $category->getSlug(),
                    '_locale' => 'fr'
                ]),
                'it' => $this->generateUrl('app_category_show', [
                    'slug' => $category->getSlug(),
                    '_locale' => 'it'
                ]),
            ];
        }
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
