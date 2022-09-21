<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category_show')]
    public function show(?Category $category): Response
    {
        if (!$category) {
            return $this->redirectToRoute('app_article_index');
        }

        return $this->render('category/index.html.twig', [
            'entity' => $category
        ]);
    }
}
