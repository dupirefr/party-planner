<?php

namespace PartyPlanner\UserBundle\Controller;
use PartyPlanner\UserBundle\Entity\User;
use PartyPlanner\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }

    /**
     * @Route("/signup")
     * @param Request $request
     */
    public function signUpAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->render('UserBundle:Default:signup.html.twig', array('form' => $form->createView()));
    }
}
