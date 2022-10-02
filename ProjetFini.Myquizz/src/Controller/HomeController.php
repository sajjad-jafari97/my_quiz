<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(CategorieRepository $categorie): Response

    {
        $repository = $categorie->findAll();
        $user = $this->getUser();
        if($user)
        {
            return $this->render('home/index2.html.twig', [
                'categorie' => $repository
             ]);
        }
        else
        return $this->render('home/index.html.twig', [
           'categorie' => $repository
        ]);
    }
}
