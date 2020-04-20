<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Group;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class DashboardController extends AbstractController
{

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {


        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository(Group::class)->findAll();

        $groupsUsuaris = $em->getRepository(Group::class)->find(2);

        return $this->render('dashboard/index.html.twig', [
            'groups' => $groups,
        ]);
    }


}
