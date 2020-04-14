<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class RegisterController extends AbstractController
{

    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {

        $user = new User();




        $form = $this->createForm(CreateUserType::class, $user);
        $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $encoded = $encoder->encodePassword($user, $form['password']->getData());
            $user->setPassword($encoded);
            $user->setRoles(['ROLE_USER']);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User Created!');
            return $this->redirectToRoute('register');
        }

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'createUser' => $form->createView(),
        ]);
    }

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


}
