<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/blog', name: 'app_article_index')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'categories' => $categoryRepository->findAll()
        ]);
    }


    #[Route('/article/{slug}', name: 'app_article_show')]
    public function show(?Article $article): Response
    {
        if (!$article) {
            return $this->redirectToRoute('app_article_index');
        }

        return $this->renderForm('article/show.html.twig', [
            'article' => $article
        ]);
    }
}
