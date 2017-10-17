<?php

namespace PartyPlanner\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{

    /**
     * @Route("admin/users", name="admin_users")
     */
    public function manageUsersAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository('UserBundle:User');
        $users = $repository->findAll();

        return $this->render('UserBundle:Admin:manageusers.html.twig', ['users' => $users]);
    }
}
