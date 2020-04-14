<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Group;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{

    /**
     * @Route("/", name="dashboard")
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
