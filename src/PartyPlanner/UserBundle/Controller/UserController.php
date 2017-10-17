<?php

namespace PartyPlanner\UserBundle\Controller;

use PartyPlanner\UserBundle\Entity\User;
use PartyPlanner\UserBundle\Form\Model\PasswordChange;
use PartyPlanner\UserBundle\Form\PasswordChangeType;
use PartyPlanner\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Controller for user profile management
 *
 * @package PartyPlanner\UserBundle\Controller
 */
class UserController extends Controller
{
    /////////////
    // Actions //
    /////////////

    /**
     * @Route("/users/{id}", name="profile")
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @param User $user
     *
     * @return Response
     */
    public function profileAction(Request $request, User $user)
    {
        $data = array();

        if ($this->getUser()->getUsername() === $user->getUsername() || $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $userForm = $this->createForm(UserType::class, $user);
            $userForm->handleRequest($request);

            $passwordChange = new PasswordChange();
            $passwordForm   = $this->createForm(PasswordChangeType::class, $passwordChange);
            $passwordForm->handleRequest($request);

            $entityManager = $this->getDoctrine()->getManager();
            if ($userForm->isSubmitted()) {
                if ($userForm->isValid()) {
                    $entityManager->merge($user);

                    $this->addFlash('success', 'Profile successfully updated');
                } else {
                    $this->addFlash('error', 'An error occurred while validating data');
                }
            } elseif ($passwordForm->isSubmitted()) {
                if ($passwordForm->isValid()) {
                    $passwordChange  = $passwordForm->getData();
                    $newPasswordHash = password_hash($passwordChange->getNewPassword(), PASSWORD_BCRYPT);

                    $user->setPassword($newPasswordHash);
                    $entityManager->merge($user);

                    $this->addFlash('success', 'Password successfully updated');
                } else {
                    $this->addFlash('error', 'An error occurred while validating data');
                }
            }
            $entityManager->flush();

            $data['userForm']     = $userForm->createView();
            $data['passwordForm'] = $passwordForm->createView();

            return $this->render('UserBundle:User:edit_profile.html.twig', $data);
        } else {
            $data['user'] = $user;
            return $this->render('UserBundle:User:profile.html.twig', $data);
        }
    }
}
