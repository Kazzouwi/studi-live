<?php 

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'category_list')]
    public function categoryList(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('categoryList.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/categories/{id}', name: 'category_show')]
    public function categoryShow(CategoryRepository $categoryRepository, $id)
    {
        $category = $categoryRepository->find($id);

        return $this->render('categoryShow.html.twig', [
            'category' => $category
        ]);
    }
}