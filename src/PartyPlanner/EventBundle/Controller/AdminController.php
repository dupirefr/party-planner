<?php

namespace PartyPlanner\EventBundle\Controller;

use PartyPlanner\EventBundle\Entity\Event;
use PartyPlanner\EventBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminController
 *
 * @package PartyPlanner\EventBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * @Route("/admin/events", name = "admin_events")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function eventsAction()
    {
        $data = array();

        $eventRepository = $this->getDoctrine()->getManager()->getRepository('EventBundle:Event');
        $events = $eventRepository->findAll();

        $data['events'] = $events;

        return $this->render('EventBundle:EventAdmin:events.html.twig', $data);
    }

    /**
     * @Route("/admin/event", name = "admin_event_creation")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createEventAction(Request $request)
    {
        return $this->handleEvent($request, new Event());
    }

    /**
     * @Route("/admin/event/{id}", name = "admin_event_update")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @param Event $event
     *
     * @return Response
     */
    public function updateEventAction(Request $request, Event $event)
    {
        return $this->handleEvent($request, $event);
    }

    /**
     * @param Request $request
     * @param Event $event
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    private function handleEvent(Request $request, Event $event)
    {
        $data = array();

        $eventForm = $this->createForm(EventType::class, $event);
        $eventForm->handleRequest($request);

        if ($eventForm->isSubmitted()) {
            if ($eventForm->isValid()) {
                $event = $eventForm->getData();
                $entityManager = $this->getDoctrine()->getManager();

                if ($event->getId() === 0) {
                    $entityManager->persist($event);
                } else {
                    $entityManager->merge($event);
                }
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
}
