<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnexionnController extends AbstractController
{
    #[Route('/connexionn', name: 'app_connexionn')]
    public function index(): Response
    {
        return $this->render('connexionn/index.html.twig', [
            'controller_name' => 'ConnexionnController',
        ]);
    }
}
