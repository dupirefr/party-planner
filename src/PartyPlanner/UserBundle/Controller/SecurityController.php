<?php

namespace PartyPlanner\UserBundle\Controller;

use PartyPlanner\UserBundle\Entity\User;
use PartyPlanner\UserBundle\Form\UserType;
use PartyPlanner\UserBundle\Form\SignInType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
	/**
	 * @Route("/", name="home")
	 *
	 * @return Response
	 */
    public function indexAction()
    {
        return $this->render('UserBundle:Security:index.html.twig');
    }

	/**
	 * @Route("/signin", name="signin")
	 *
	 * @param Request $request
	 * @return Response
	 */
    public function signInAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        $data['last_username'] = $lastUsername;
        $data['error'] = $error;

        $user = new User();
        $form = $this->createForm(SignInType::class, $user);

        $data['form'] = $form->createView();

        return $this->render('UserBundle:Security:signin.html.twig', $data);
    }

    /**
     * @Route("/signup", name="signup")
     *
     * @param Request $request
     * @return Response
     */
    public function signUpAction(Request $request)
    {
    	$data = array();

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $data['infoBag'][] = 'Successfully registered';

	        return $this->render('UserBundle:Security:index.html.twig', $data);
        } else if ($form->isSubmitted() && !$form->isValid()) {
        	$data['errorBag'][] = 'An error occurred while validating data';
        }

        $data['form'] = $form->createView();

        return $this->render('UserBundle:Security:signup.html.twig', $data);
    }

    /**
     * @Route("/signout", name="signout")
     */
    public function signOutAction()
    {
        // Handled by Symfony
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        # code...
    }
}
