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
 * Class EventController
 *
 * @package PartyPlanner\EventBundle\Controller
 */
class EventController extends Controller
{
    /**
     * @Route("/events", name = "events")
     * @Security("has_role('ROLE_USER')")
     */
    public function eventsAction()
    {
        $data = array();

        $eventRepository = $this->getDoctrine()->getManager()->getRepository('EventBundle:Event');
        $events = $eventRepository->findAll();

        $data['events'] = $events;

        return $this->render('EventBundle:Event:list.html.twig', $data);
    }

    /**
     * @Route("/event/{id}", name = "event")
     * @Security("has_role('ROLE_USER')")
     *
     * @param Event $event
     *
     * @return Response
     */
    public function eventAction(Event $event)
    {
        $data = array();
        $data['event'] = $event;

        return $this->render('EventBundle:Event:single.html.twig', $data);
    }
}
