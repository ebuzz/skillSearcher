<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Skill;
use Symfony\Component\HttpFoundation\Response;

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
     * @Template("AppBundle:Skill:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $skills = $em->getRepository('AppBundle:Skill')->findAll();
        return array(
            'skills' => $skills,
        );
    }
    /**
     * Displays a form to create a new Skill entity.
     *
     * @Route("/new", name="skill_new")
     * @Template()
     */
    public function newAction()
    {
        return $this->render('AppBundle:Skill:new.html.twig');
    }

    /**
     * Creates a new Skill entity.
     *
     * @Route("/create", name="skill_create")
     * @Method("POST")
     * @Template("AppBundle:Skill:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $skill = new Skill();

        $skill ->setName($request->get('name'));
        $em       ->persist($skill);
        $em       ->flush();

        return $this->redirectToRoute('skills');
    }

    /**
     * Displays a form to edit an existing Skill entity.
     *
     * @Route("/{id}/edit", name="skill_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $skill = $em->getRepository('AppBundle:Skill')->find($id);

        $error = " ";
        if (!$skill) {
            $error = "true";
            return $this->redirectToRoute('skills', array(
                'error'     => $error,
                )); 
        }

        return array(
            'skill'   => $skill,
            'error'   => $error,
        );
    }

    /**
     * Deletes a Skill entity.
     *
     * @Route("/{id}/delete", name="skill_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $skill = $em->getRepository('AppBundle:Skill')->find($id);
        if (!$skill) {
            throw $this->createNotFoundException('Unable to find skill selected.');
        }
        $em->remove($skill);
        $em->flush();
        return $this->redirectToRoute('skills');
    }

    /**
     * Edits an existing Skill entity con AJAX.
     *
     * @Route("/update", name="skill_update_ajax", options={"expose"=true})
     * @Method("POST")
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $skill = $em->getRepository('AppBundle:Skill')->find($id);

        $skill->setName($request->get('name'));
        $em->persist($skill);
        $em->flush();
        $result = "";
        $response = new Response();
        $response->setContent(json_encode(array('result' => $result)));
        return $response;
    }

}