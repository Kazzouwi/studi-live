<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'article_list')]
    public function articleList(ArticleRepository $articleRepository)
    {       
        $articles = $articleRepository->findAll();


      
        return $this->render('articleList.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/articles/{id}', name: 'article_show')]
    public function articleShow(ArticleRepository $articleRepository, $id)
    {
        $article = $articleRepository->find($id);

        return $this->render('articleShow.html.twig', [
            'article' => $article
        ]);
    }
}