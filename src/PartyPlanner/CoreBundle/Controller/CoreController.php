<?php

namespace PartyPlanner\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CoreController extends Controller
{
    /**
	 * @Route("/", name="home")
	 *
	 * @return Response
	 */
    public function indexAction()
    {
        return $this->render('CoreBundle:Core:index.html.twig');
    }
}
