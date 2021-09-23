<?php
namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController {

    /**
     * @Route("/add", name="add")
     */
    public function add(EntityManagerInterface $em, Request $request){
        $form = $this->createForm(CategoryType::class, new Category());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $category = $form->getData();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('category_getall');
        }
        return $this->render('category/add.html.twig',
            [
                'form'=> $form->createView()
            ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Category $category, EntityManagerInterface $em, Request $request){
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $category = $form->getData();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('category_getall');
        }
        return $this->render('category/edit.html.twig',
            [
                'form'=> $form->createView(),
                'id'=> $category->getId()
            ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('category_getall');
    }

    /**
     * @Route("", name="getall")
     */
    public function getAll(CategoryRepository $categoryRepository){
        $categs = $categoryRepository->findAll();

        return $this->render('category/list.html.twig', [
            'categories'=> $categs
        ]);
    }

    /**
     * @Route("/{category}", name="detail", requirements={"category"="\d+"})
     */
    public function getOne(CategoryRepository $categoryRepository, Category $category){
        return $this->render("category/detail.html.twig", [
            'categ'=> $category
        ]);
    }
}
