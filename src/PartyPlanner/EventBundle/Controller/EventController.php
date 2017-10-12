<?php

namespace PartyPlanner\EventBundle\Controller;

use PartyPlanner\EventBundle\Entity\Event;
use PartyPlanner\EventBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EventController
 *
 * @package PartyPlanner\EventBundle\Controller
 */
class EventController extends Controller
{
    /**
     * @Route("/admin/event", name = "admin_event_creation")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function eventCreationAction(Request $request)
    {
        $data = array();

        $event = new Event();

        $eventForm = $this->createForm(EventType::class, $event);
        $eventForm->handleRequest($request);

        if ($eventForm->isSubmitted()) {
            if ($eventForm->isValid()) {
                $event = $eventForm->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($event);
                $entityManager->flush();

                $this->addFlash('success', 'Event successfully created');
                return $this->redirectToRoute('admin_events');
            } else {
                $this->addFlash('error', 'An error occurred while validating data');
            }
        }

        $data['eventForm'] = $eventForm->createView();

        return $this->render('EventBundle:EventAdmin:event_form.html.twig', $data);
    }

    /**
     * @Route("/admin/events", name = "admin_events")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function eventList()
    {
        $data = array();

        $eventRepository = $this->getDoctrine()->getManager()->getRepository('EventBundle:Event');
        $events = $eventRepository->findAll();

        $data['events'] = $events;

        return $this->render('EventBundle:EventAdmin:events.html.twig', $data);
    }
}
