<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{   
    #[Route('/{name}/{id}', name: 'app_quizz')]

    public function index(QuestionRepository $question,ReponseRepository $reponse,int $id, string $name): Response
    {
        $questions = $question->findBy(['id_categorie' => $id]);
        $tab = array();
        foreach($questions as $key => $val){
        $id_question = $questions[$key]->getId();
            array_push($tab,$id_question);
        }


        $reponses = $reponse->findBy(['id_question' => $tab]);
        
        // $rep = $reponses->find('id_question'=>)


        

  
        return $this->render('quizz/index.html.twig', [
            'questionQuizz' => $questions,
            'nameCategorie'=>$name, 
            'reponsesQuizz' => $reponses,
        ]);
    }
    // public function reponse(ReponseRepository $reponse,): Response
    // {   
    //     global $id_question;
       
    //     return $this->render('quizz/index.html.twig', [

    //     ]);
    // }


    
}
