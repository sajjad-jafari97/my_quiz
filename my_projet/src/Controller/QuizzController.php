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
        // $test = array();
        // foreach($tab as $key=>$val){
        //     $test = $val;
        // }
        // dd($tab);
       
        
        $reponses = $reponse->findBy(['id_question' => $tab]);

    
        // $test = array();
        // foreach($reponses as $key => $val){
        // $id_test = $reponses[1]->;
        //     array_push($test,$id_test);
        // }
        // dd($test);

        

  
        return $this->render('quizz/index.html.twig', [
            'questionQuizz' => $questions,
            'nameCategorie'=>$name, 
            'reponsesQuizz' => $reponses,
        ]);
    }



    
}