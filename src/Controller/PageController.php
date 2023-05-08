<?php 

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(ArticleRepository $articleRepository, CategoryRepository $categoryRepository)
    {
        $lastArticles = $articleRepository->findBy([], ['id' => 'DESC'], 2);

        $lastCategories = $categoryRepository->findBy([], ['id' => 'DESC'], 2);

        return $this->render('home.html.twig', [
            'lastArticles' => $lastArticles,
            'lastCategories' => $lastCategories
        ]);
    }
}