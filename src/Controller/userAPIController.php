<?php

namespace App\Controller;


use App\Entity\User;

use App\Form\CreateUserType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;





class userAPIController extends AbstractFOSRestController
{

    private $serializer;

    public function __construct(
        SerializerInterface $serializer
    )  {
        $this->serialize = $serializer;
    }

    /**
     * @Route("/testing", name="testing", methods={"POST"})
     */
    public function getLoginAction()
    {
        return $this->json([
            'message' => 'hola soc un metode automatic de userAPIController',
            'path' => 'src/controller/ListController.php'
        ]);
    }

    /**
     * @Route("/createUser", name="createUser", methods={"POST"})
     */
    public function postSignupAction(Request $request, UserPasswordEncoderInterface $encoder, SerializerInterface $serializer) {


        // this header is only included in this request and overrides the value
// of the same header if defined globally by the HTTP client
        $response = $client->request('POST', 'https://...', [
            'headers' => [
                'Content-Type' => 'text/plain',
            ],
        ]);

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
