<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/c/r/u/d')]
class CRUDController extends AbstractController
{
    #[Route('/', name: 'app_c_r_u_d_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $user = $this->getUser();
       // var_dump($user->getRoles());
        if(count($user->getRoles()) == 2) //2 element = tu es admin
        {
           // echo "tu as plus d'un element dans le tableau";
            return $this->render('crud/index.html.twig', [
                'users' => $userRepository->findAll(),
            ]);
        }
        else // else t'es pas admin
        
       //echo  $user->getId();
        return $this->render('crud/index2.html.twig', [
            'user' => $userRepository->find($user->getId()),
            //'users' => $userRepository->findOneBy(['id' => 14]),
        ]);
        
        
    }

    #[Route('/new', name: 'app_c_r_u_d_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_r_u_d_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        if(count($user->getRoles()) == 2)
        {
            return $this->render('crud/show.html.twig', [
                'user' => $user,
            ]);
        }
        else 
        return $this->render('crud/show2.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_r_u_d_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }
        if(count($user->getRoles()) == 2)
        {
            return $this->renderForm('crud/edit.html.twig', [
                'user' => $user,
                'form' => $form,
            ]);
        }
        else 
        dump($form->getData());
        return $this->renderForm('crud/edit2.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);

    }

    #[Route('/{id}', name: 'app_c_r_u_d_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
    }
}
