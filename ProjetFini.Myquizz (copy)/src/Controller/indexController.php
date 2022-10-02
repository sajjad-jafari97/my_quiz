<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class indexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]

    public function index(): Response
    {
        $user = $this->getUser();
        if($user->isVerified()==false)
        {
            //var_dump($user->isVerified());
            return $this->render('emailpasconfirm/emailpasconfirm.html.twig', [
                'controller_name' => 'SecurityController',
            ]);
        }
        
       // var_dump($user->isVerified());
        
        return $this->render('index/index.html.twig', [
            'controller_name' => 'indexController',
        ]);
        
    }
}