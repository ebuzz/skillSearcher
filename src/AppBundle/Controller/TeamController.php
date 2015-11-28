<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\UserSkill;
use AppBundle\Entity\UserTeam;
use AppBundle\Entity\Team;
use AppBundle\Entity\User;
use AppBundle\Entity\UserSkillTeam;

class TeamController extends Controller
{
	/**
     * Add User To Team
     *
     * @Route("/userteam/", name="teami", options={"expose"=true})
     * Method("POST")
     */
    public function addUserTeamAction(Request $request)
    {
        $skills = $request->get('skills');
        $teams = $request->get('userteams');
        $em = $this->getDoctrine()->getManager();

        // UserTeams
        $jsonStringUserTeam = json_encode($teams);
        $jsonUserTeamObject = json_decode($jsonStringUserTeam);

        // Create UserTeam foreach team selected
        foreach($jsonUserTeamObject as $userTeamObject)
        {
            // $usersIds[] = $userTeamObject->idUser;
            // $teamsIds[] = $userTeamObject->idTeam;
            $userId = $userTeamObject->idUser;
            $teamId = $userTeamObject->idTeam;
            
            $team = $em->getRepository('AppBundle:Team')->find($teamId);
            $user = $em->getRepository('AppBundle:User')->find($userId);

            $userTeam = new UserTeam();
            $userTeam->setUser($user);
            $userTeam->setTeam($team);
            $em->persist($userTeam);
            $em->flush();

            $userTeamId = $userTeam->getUserTeamId();
            //  Skills
            $jsonstring = json_encode($skills);
            $jsonUserSkillObject = json_decode($jsonstring);
            // Put each UserSkill selected in UserTeam
            foreach($jsonUserSkillObject as $userSkillObject)
            {
                $userSkillId = $userSkillObject->idUserSkill;
                $userTeam = $em->getRepository('AppBundle:UserTeam')->find($userTeamId);
                $userSkill = $em->getRepository('AppBundle:UserSkill')->find($userSkillId);
                $userSkillTeam = new UserSkillTeam();
                $userSkillTeam->setUserSkill($userSkill);
                $userSkillTeam->setUserTeam($userTeam);
                $em->persist($userSkillTeam);
                $em->flush();

                $result = true;
            }
        }
        
        $response = new Response();
        //$response->setContent(json_encode(array('UserTeamId'=>$userTeamId, 'userIds' => $usersIds,'teamsIds' => $teamsIds, 'skillsIds' => $skillsIds)));
        $response->setContent(json_encode(array('result' => $result)));
        return $response;
    }
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
        $users = $em->getRepository('AppBundle:UserTeam')->findByUserSelected($id);
        $userSkill = $em->getRepository('AppBundle:UserSkillTeam')->findBySkillSelected($id);

        // die($users);
        return array(
            'team'  => $team,
            'users' => $users,
            'userSkill' => $userSkill,
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