<?php 

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/admin/articles', name: 'admin_article_list')]
    public function adminArticleList(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();


      
        return $this->render('admin/articleList.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/admin/article/delete/{id}', name: 'admin_article_delete')]
    public function adminArticleDelete(ArticleRepository $articleRepository, EntityManagerInterface $entityManager ,$id)
    {
        $article = $articleRepository->find($id);

        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('admin_article_list');
    }

    #[Route('/admin/article/insert', name: 'admin_article_insert')]
    public function adminArticleInsert(EntityManagerInterface $entityManager, Request $request)
    {
        $article = new Article();

        $articleForm = $this->createForm(ArticleType::class, $article);

        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();
        }


        return $this->render('admin/articleInsert.html.twig', [
            'articleForm' => $articleForm->createView()
        ]);
    }

    #[Route('/admin/article/update/{id}', name: 'admin_article_update')]
    public function adminArticleUpdate(EntityManagerInterface $entityManager, Request $request, $id, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->find($id);

        $articleForm = $this->createForm(ArticleType::class, $article);

        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();
        }


        return $this->render('admin/articleInsert.html.twig', [
            'articleForm' => $articleForm->createView()
        ]);
    }
}