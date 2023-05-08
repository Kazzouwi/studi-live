<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/{age}', name: 'home')]
    public function home($age)
    {

        if( $age < 18 ) {
            return $this->redirectToRoute('underage');
        }

        return $this->render('home.html.twig', [
            'age' => $age
        ]);
        
    }

    #[Route('/test/underage', name: 'underage')]
    public function underage(Request $request)
    {
        $age = $request->query->get('age');

        return $this->render('underage.html.twig', [
            'age' => $age
        ]);
        
    }

    #[Route('/contact', name: 'contact')]
    public function contact()
    {
        return $this->render('contact.html.twig');
    }
}