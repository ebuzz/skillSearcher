<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Position controller.
 *
 * @Route("/position")
 */
class PositionController extends Controller
{
	/**
     * Lists all User entities.
     *
     * @Route("/", name="positions")
     * @Template("AppBundle:Position:show.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $positions = $em->getRepository('AppBundle:Position')->findAll();
        return array(
            'positions' => $positions,
        );
    }

}