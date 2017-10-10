<?php

namespace PartyPlanner\UserBundle\Controller;

use PartyPlanner\UserBundle\Entity\User;
use PartyPlanner\UserBundle\Form\SignInType;
use PartyPlanner\UserBundle\Form\SignUpType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
        if (!$this->isGranted('ROLE_USER')) {
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
        } else {
            $this->addFlash('warning', 'You\'ve already signed in');
            return $this->redirectToRoute('home');
        }
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
        $form = $this->createForm(SignUpType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            if ($form->isValid()) {
                $user = $form->getData();
                $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Successfully registered.');
                return $this->redirectToRoute('home');
            } else {
                $this->addFlash('error', 'An error occurred while validating data.');
            }
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
