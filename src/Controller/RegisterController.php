<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request)
    { 

        $user = new User();
        $form = $this->createForm(CreateUserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user->setRoles(0);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User Created!');
            return $this->redirectToRoute('register');
        }

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'createUser' => $form->createView()
        ]);
    }
}
