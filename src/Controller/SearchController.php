<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ArticleRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(ArticleRepository $articleRepository, Request $request): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $filtres = $form->getData();
            $articles = $articleRepository->search($filtres);
        } else {
            $articles = $articleRepository->findAll();
        }

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'articles' => $articles,
        ]);
    }
}
