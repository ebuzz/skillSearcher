<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Skill;
use AppBundle\Entity\UserSkill;
use AppBundle\Entity\Vote;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     * @Template("AppBundle:Dashboard:dashboard.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->lastUpdates();
        $userLogged = $this->getUserIdLogged();

        return array(
            'users' => $users,
            'userLogged' => $userLogged,
        );
    }
    /**
     * @Route("/registered", name="registered", options={"expose"=true})
     * @Method("POST")
     */
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName($request->get('name'));
        $user->setLastName($request->get('lastName'));
        $user->setPassword($request->get('password'));
        $user->setUsername($request->get('email'));
        $user->setRoles('ROLE_USER');
        $user->setAdmissionDate(null);
        $em->persist($user);
        $em->flush();
        $user->getUserId();

        $token = new UsernamePasswordToken($user, null, 'default', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);

        return $this->redirect($this->generateUrl('user_edit', array(
            'id' => $user->getUserId()
        )));
    }

    /**
     * Gets all users with its skills.
     *
     * @Route("/busqueda",name="search_user")
     * @Method("GET")
     * @Template("AppBundle:Search:search.html.twig")
     */
    public function searchAction(Request $request)
    {  
        $em = $this->getDoctrine()->getManager();

        $searchText = $request->get('search-box');
        $searchType = $request->get('search-type');
        $teams = $em->getRepository('AppBundle:Team')->findAll();
        $userLogged = $this->getUserIdLogged();

        switch ($searchType) {
            case "user":
                $searchResults = $em->getRepository('AppBundle:User')->findBySearch($searchText);
                break;
            case "skill":
                $searchResults = $em->getRepository('AppBundle:Skill')->searchSkill($searchText);
                break;
            case "account":
                $searchResults = $em->getRepository('AppBundle:Account')->searchAccount($searchText);
                break;
            case "position":
                $searchResults = $em->getRepository('AppBundle:Position')->searchPosition($searchText);
                break;
            default:
                $searchResults = $em->getRepository('AppBundle:User')->usersRating();
                break;
        }

        $all = $em->getRepository('AppBundle:User')->usersRating();

        return array(
            'searchResults' => $searchResults,
            'teams' => $teams,
            'all' => $all,
            'searchType' => $searchType,
            'searchText' => $searchText,
            'userLogged' => $userLogged,
        );
    }

    /**
     * @Route("/rating", name="rating", options={"expose"=true})
     */
    public function rateSkillAction(Request $request)
    {
        $result = 'false';
        $id = $request->get('term');
        $em = $this->getDoctrine()->getManager();

        $userSkill = $em->getRepository('AppBundle:UserSkill')->find($id);
        $userSkillId = $userSkill->getUserSkillId();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getUserId();
        $userVoting = $em->getRepository('AppBundle:User')->find($userId);
        $userInVoteExistObject = $em->getRepository('AppBundle:Vote')->findOneBy(
            array('user' => $userId, 'userkill' => $userSkillId)
        );

        if ($userInVoteExistObject) {
            $em->remove($userInVoteExistObject);
            $em->flush();
        } else {
            $voteEntity = new Vote();
            $voteEntity->setUserSkill($userSkill);
            $voteEntity->setUser($userVoting);
            $em->persist($voteEntity);
            $em->flush();
            $result = 'true';
        }

        $counts = $em->getRepository('AppBundle:Vote')->counting($id);

        foreach ($counts as $count) {
            $total = ($count['rate']);
        }
        $response = new Response();
        $response->setContent(json_encode(array('total' => $total, 'status' => $result)));
        return $response;
    }

    /**
     * @Route("/verify_mail", name="verify_mail", options={"expose"=true})
     */
    public function verifyMail(Request $request)
    {
        $value = $request->get('term');
        $em = $this->getDoctrine()->getEntityManager();
        $username = $em->getRepository('AppBundle:User')->findByusername($value);

        $result = 'false';
        if (!empty($username)) {
            $result = 'true';
        }

        $response = new Response();
        $response->setContent($result);

        return $response;
    }

}
