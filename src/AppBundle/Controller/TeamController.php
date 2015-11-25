<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Team;
use AppBundle\Entity\UserTeam;

/**
 * Team controller.
 *
 * @Route("/team")
 */
class TeamController extends Controller
{
	/**
     * Lists all User entities.
     *
     * @Route("/", name="team")
     * @Template("AppBundle:Team:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')->findAll();
        return array(
            'teams' => $team,
        );
    }
    /**
     * Displays a form to create a new Team entity.
     *
     * @Route("/new", name="team_new")
     * @Template()
     */
    public function newAction()
    {
        return $this->render('AppBundle:Team:new.html.twig');
    }

    /**
     * Creates a new Team entity.
     *
     * @Route("/create", name="team_create")
     * @Method("POST")
     * @Template("AppBundle:Team:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $team = new Team();

        $team ->setName($request->get('name'));
        $em   ->persist($team);
        $em   ->flush();

        return $this->redirectToRoute('team');
    }

    /**
     * Finds and displays a Team entity.
     *
     * @Route("/{id}", name="team_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        // $userTeamRepository = $em->getRepository('AppBundle:UserSkillTeam');
        $team = $em->getRepository('AppBundle:Team')->find($id);
        if (!$team) {
            throw $this->createNotFoundException('Unable to find Team entity.');
        }
        // $users = $em->getRepository('AppBundle:UserTeam')->findByUserSelected($id);
        // $userSkill = $em->getRepository('AppBundle:UserTeam')->getSkillSelected($id);

        return array(
            'team'  => $team,
            // 'users' => $users,
            // 'userSkill' => $userSkill,
        );
    }

    /**
     * Displays a form to edit an existing Team entity.
     *
     * @Route("/{id}/edit", name="team_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $team = $em->getRepository('AppBundle:Team')->find($id);

        $error = " ";
        if (!$team) {
            $error = "true";
            return $this->redirectToRoute('team', array(
                'error'     => $error,
                )); 
        }

        return array(
            'team'   => $team,
            'error'     => $error,
        );
    }

    /**
     * Edits an existing Team entity.
     *
     * @Route("/{id}/update", name="team_update")
     * @Method("POST")
     * @Template("AppBundle:Team:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')->find($id);

        $team->setName($request->get('name'));
        $em     ->persist($team);
        $em     ->flush();

        return $this->redirectToRoute('team');
    }
    /**
     * Deletes a Team entity.
     *
     * @Route("/{id}/delete", name="team_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')->find($id);
        if (!$team) {
            throw $this->createNotFoundException('Unable to find team selected.');
        }
        $em->remove($team);
        $em->flush();
        return $this->redirectToRoute('team');
    }

}