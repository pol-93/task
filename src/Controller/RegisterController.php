<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
<<<<<<< HEAD
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
=======
>>>>>>> 1c0bc86e7b61873b7ce3d6ed84fbb2604d0d0c3b

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
<<<<<<< HEAD
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
=======
    public function index(Request $request)
>>>>>>> 1c0bc86e7b61873b7ce3d6ed84fbb2604d0d0c3b
    { 

        $user = new User();
        $form = $this->createForm(CreateUserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user->setRoles(0);
<<<<<<< HEAD
            $encoded = $encoder->encodePassword($user, $form['password']->getData());
            $user->setPassword($encoded);
=======
>>>>>>> 1c0bc86e7b61873b7ce3d6ed84fbb2604d0d0c3b
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
