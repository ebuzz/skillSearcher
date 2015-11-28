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
     * @Route("/userteam/", name="team", options={"expose"=true})
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

}