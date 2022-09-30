<?php

namespace App\Controller;

use App\Repository\ReponseRepository;
use App\Repository\QuestionRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReponseController extends AbstractController
{
    #[Route('/reponse', name: 'app_reponse')]
    public function index(ReponseRepository $reponse,QuestionRepository $question,CategorieRepository $categorie,Request $request): Response
    {
        
        $idC = $request->query->get('idCategorie');
        $nameCategoie = $request->query->get('nameCategorie');
        $repUtilisateur = $request->query;
        $tabReponse=array();
        foreach($repUtilisateur as $key=>$val){
            if(is_int($key)){
                array_push($tabReponse,$val);
            }
        }
        $reponseClient = $reponse->findBy(["reponse" => $tabReponse]);
                
        $questions = $question->findBy(['id_categorie' => $idC]);
        $tab = array();
        foreach($questions as $key => $val){
        $id_question = $questions[$key]->getId();
            array_push($tab,$id_question);
        }
        $reponses = $reponse->findBy(['id_question' => $tab]);
        return $this->render('reponse/index.html.twig', [
             'questionQuizz' => $questions,
             'nameCategorie'=>$nameCategoie,
             'idCategorie'=>$idC, 
             'reponsesQuizz' => $reponses,
             'reponseUtilisateur' => $reponseClient,
 
        ]);
    }
}
