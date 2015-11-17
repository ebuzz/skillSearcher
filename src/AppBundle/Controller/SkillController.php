<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Skill controller.
 *
 * @Route("/skill")
 */
class SkillController extends Controller
{
	/**
     * Lists all User entities.
     *
     * @Route("/", name="skills")
     * @Template("AppBundle:Skill:show.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $skills = $em->getRepository('AppBundle:Skill')->findAll();
        return array(
            'skills' => $skills,
        );
    }

}