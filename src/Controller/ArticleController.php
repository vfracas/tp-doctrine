<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/category/{category}", name="article_by_category")
     */
    public function articleByCategory(Category $category, ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBy(['category'=> $category]);

        return $this->render('article/article_by_categ.html.twig', [
            'articles' => $articles
        ]);
    }

}
