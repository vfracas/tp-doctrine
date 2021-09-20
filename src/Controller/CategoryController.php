<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/category/{name}", name="category_add")
     */
    public function add(EntityManagerInterface $entityManager, $name): Response
    {
        $category = new Category();
        $category->setName($name);
        $entityManager->persist($category);
        $entityManager->flush();

        return $this->render('category/add.html.twig', [
        ]);
    }

}
