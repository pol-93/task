<?php

namespace App\Controller;


use App\Entity\User;

use App\Form\CreateUserType;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;









/**
 * Class ApiController
 *
 * @Route("/api")
 */
class APIController extends AbstractController
{

    private $serializer;

    public function __construct(
        SerializerInterface $serializer
    )  {
        $this->serialize = $serializer;
    }

    /**
     * @Rest\Post("/login_check", name="user_login_check")
     *
     * @SWG\Response(
     *     response=200,
     *     description="User was logged in successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not logged in successfully"
     * )
     *
     * @SWG\Parameter(
     *     name="_username",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={
     *     }
     * )
     *
     * @SWG\Parameter(
     *     name="_password",
     *     in="body",
     *     type="string",
     *     description="The password",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="User")
     */

    public function loginCheckAction()
    {

    }

    /**
     *
     * @Route("/registerAction", name="registerAction", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="User was successfully registered"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not successfully registered"
     * )
     *
     *
     * @SWG\Parameter(
     *     name="Email",
     *     in="body",
     *     type="string",
     *     description="The Email for the user registration",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="_password",
     *     in="query",
     *     type="string",
     *     description="The Password for the user registration",
     * )
     *
     * @SWG\Parameter(
     *     name="Username",
     *     in="body",
     *     type="string",
     *     description="The username for the registration",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="User")
     *
     */

    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder, SerializerInterface $serializer) {
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
        $user = [];
        $message = "";
        $code = 200;
        try{
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
            }
        }catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $exception){
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to register the user - Error: {$exception->getMessage()}";
        }
        $response = [
            'code' => $code,
            'error' => false,
            'data' => $code == 200 ? $user : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }
}
