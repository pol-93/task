<?php

namespace App\Controller;


use App\Entity\Preference;
use App\Entity\TaskList;
use App\Repository\GroupRepository;
use App\Repository\TaskListRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use Symfony\Component\HttpFoundation\Response;

class ListController extends AbstractFOSRestController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var TaskRepository
     */
    private $groupRepository;

    public function __construct(GroupRepository $group,EntityManagerInterface $entityManager)
    {
        $this->groupRepository = $group;
        $this->entityManager = $entityManager;
    }

    /**
     * @Rest\Get("api/getGroups")
     */
    public function getGroupsAction()
    {
        /*
        $RAW_QUERY = 'SELECT * FROM group_user';
        $em = $this->getDoctrine()->getManager();
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();


        $result = $statement->fetchAll();

        return $this->view($result, Response::HTTP_OK);
        */


    }
}
