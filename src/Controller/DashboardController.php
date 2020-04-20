<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Group;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;



use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;

class DashboardController extends AbstractController
{

    private $key = '74ffd9af0d2acdd65129dc9a8e05deb3';
    private $jwtEncoder;

    public function __construct(JWTEncoderInterface $jwtEncoder)
    {
        $this->jwtEncoder = $jwtEncoder;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1ODczOTgxNzYsImV4cCI6MTU4NzM5ODIwNiwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoicG9sY2VyZGFuQGdtYWlsLmNvbSJ9.lvetdSlnIgim5kXqthIDo4sFbm5Ys6y_nZgIM5q7M_2SrmPhLqwm5Ow_0ziO5CNtoGdG3HvRO2MW7wY_pNsM4ENRHXOTYTqnsgqwZGEyzJJ6jVPOoew2Bx4P7p0XLhW9v2OKFFxOg0Y1Aw0v8CbtQuPqFVxfHg2BxzNuXa9UIp6-AK34sU7fH0LhDeHHND3TZP3BdU0ihgC9wr07KRMaEQbfILStRL6RIV7RrT9EEsrAezBcGsD0ibPy6Esu4AXillbzedEjs3jyFsDcovU25ujkNo1Q3w-uAPv3k6x3WChPlgCSnMb0sVBB1GvOfVxpXSitvSGIesyWxujN2Sr72PiqA9y-GRv25xqA3jDFLoR6lCHQS9r7ZGoZ2heahOOKc6TLU6X1HhOB40luzLqUaudPmRHTLNcxmhv_UOPqAibOzaMPlysvTQ-HKxkViEIG6Lvd3x2o3-hvBCZHZ2OX0NruTRxJMPE_6-Hokpb3himFjDnQVFRu644Ahm1EVjuN6ldHWweS8c4hhCS10cJoAPuqjRTEdwWlFwCLb-WRF9_tlvHtAZomTsM2FPUCFb-xpB517XrZUUVJtigyopju4-zNT5ubwged9T0rvRZ2HdUf1YHRfdPgQjQ7izz1zKhiWHahUiqbni-tYh3c2GEjwcTIWbcN2GcczhKLsFBsjj8";

        try {
            $hola = $this->jwtEncoder->decode($token);
            dump($hola);
        } catch (JWTDecodeFailureException $ex) {
            dump($ex);
        }

        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository(Group::class)->findAll();

        $groupsUsuaris = $em->getRepository(Group::class)->find(2);

        return $this->render('dashboard/index.html.twig', [
            'groups' => $groups,
        ]);
    }



}
