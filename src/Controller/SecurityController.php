<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\NativeHttpClient;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */

    public function login(Request $request,AuthenticationUtils $authenticationUtils): Response
    {


        $user = new User();

        $title = $request->attributes->get('title');



        $form = $this->createForm(CreateUserType::class, $user, [
            'action' => $this->generateUrl('createUser'),
            'attr' => ['id' => 'generateUser'],
            'method' => 'POST',
        ]);


        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error,
            'createUser' => $form->createView()]);

    }



    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
