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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/login", name="login_route")
     * @Template("AppBundle:Security:login.html.twig")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error'         => $error,
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }

    /**
     *
     * @Route("/register", name="register", options={"expose"=true})
     * @Method("GET")
     * @Template("AppBundle:User:register.html.twig")
     */
    public function registerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accounts = $em->getRepository('AppBundle:Account')->findAll();
        $positions = $em->getRepository('AppBundle:Position')->findAll();
        return array(
            'accounts' => $accounts,
            'positions' => $positions,
        );
    }

    /**
     * @Route("/registered", name="registered", options={"expose"=true})
     * @Method("POST")
     */
    public function addSkillAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod()=="POST") {

            $user = new User();
            $dateAdmission = $request->get('admissionDate');
            $accounts = $request->get('account');
            $skills = $request->get('skills');


            $position = $em->getRepository('AppBundle:Position')->find($request->get('position'));

            if(!empty($dateAdmission))
            {
                $dateAdmission = date_create_from_format('Y-m-d',$dateAdmission);
                $user->setAdmissionDate($dateAdmission);
            }

            if (!empty($accounts)) {
                foreach ($accounts as $account) {
                    $account = $em->getRepository('AppBundle:Account')->find($account);
                    $user->addAccount($account);
                }
            }
            $user->setName($request->get('name'));
            $user->setLastName($request->get('lastName'));
            $user->setSurName($request->get('surName'));
            $user->setPassword($request->get('password'));
            $user->setUsername($request->get('email'));
            $user->setFile($request->files->get('image'));
            $user->setPosition($position);
            $user->setRoles('ROLE_USER');
            $em->persist($user);
            $em->flush();
            $user->getUserId();

            $token = new UsernamePasswordToken($user, null, 'default', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);

            if (!empty($skills)) {
                $this->AddSkills($skills,$user);
            }
        }
        return $this->redirect($this->generateUrl('homepage'));
    }

    private function AddSkills($skills,$user){
        foreach ($skills as $userSkill) {

            $userSkillEntity = new UserSkill();
            $em = $this->getDoctrine()->getManager();
            
            if ($userSkill["id"] == "") {
                $skillEntity = new Skill();
                $skillEntity->setName($userSkill["name"]);
                $em->persist($skillEntity);
                $skillEntity->getSkillId();

                $userSkillEntity->setSkill($skillEntity);
                $userSkillEntity->setUser($user);
                $em->persist($userSkillEntity);
                $em->flush();
            }
            elseif($userSkill["id"] != ""){
                $skill = $em->getRepository('AppBundle:Skill')->find($userSkill["id"]);
                $skill->getSkillId();
                $userSkillEntity->setSkill($skill);
                $userSkillEntity->setUser($user);
                $em->persist($userSkillEntity);
                $em->flush();
            }
        }
    }

    /**
     * Gets all users with its skills.
     *
     * @Route("/busqueda",name="search_user")
     * @Method("GET")
     * @Template("AppBundle:Search:search.html.twig")
     */
    public function getUsersWithSkillsAction(Request $request)
    {
        // Get values
        $searchText = $request->get('search-box');
        $searchType = $request->get('search-type');
        // Instatiate em
        $em = $this->getDoctrine()->getManager();
        // This will be used no matter what ?
        $userRepository = $em->getRepository('AppBundle:User');
        $accountRepository = $em->getRepository('AppBundle:Account');
        $skillRepository = $em->getRepository('AppBundle:Skill');
        // Cases
        if($searchType == "user"){
            $results = $userRepository->findBySearch($searchText);
            if(empty($searchText)){
                $results = $userRepository->findAll();
            }
            $allAccounts = null;
            $allSkills = null;
        }

        if($searchType == "skill"){
            $allSkills = $skillRepository->findByName($searchText);
            if(empty($searchText)){
                $allSkills = $skillRepository->findAll();
            }
            $allAccounts = null;
            $results = null;
        }

        if($searchType == "account"){
            $allAccounts = $accountRepository->findByName($searchText);
            if(empty($searchText)){
                $allAccounts = $accountRepository->findAll();
            }
            $results = null;
            $allSkills = null;
        }
        
        $listAccounts = $accountRepository->findAll();

        return array(
            'allAccounts' => $allAccounts,
            'listAccounts' => $listAccounts,
            'allSkills' => $allSkills,
            'results' => $results,
            'searchType' => $searchType,
            'searchText' => $searchText
        );
    }

    /**
     * Rate User Skill 
     *
     * @Route("/busqueda/califica/userskill/{id}",name="rate_user")
     * @Method("GET")
     * @Template()
     */
    public function rateUserSkillAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        // Get UserSkill Entity
        $userSkillRepository = $em->getRepository('AppBundle:UserSkill');   
        $userSkill = $userSkillRepository->find($id);
        // Get UserSkll Id
        $userSkillId = $userSkill->getUserSkillId();

        // Instantiate Repo and gettin' user from session
        $userRepository = $em->getRepository('AppBundle:User');
        $user = $this->get('security.token_storage')->getToken()->getUser(); 
        $userId = $user->getUserId();
        // Get entity from User who is voting
        $userVoting = $userRepository->find($userId);

        // Verify if the logged user hasn't already voted for the same skill
        $voteRepository = $em->getRepository('AppBundle:Vote');

        // $userInVoteExist = $voteRepository->findByUser($userId);
        // $userSkillInVoteExist = $voteRepository->findByUserkill($userSkillId);
        $message1 = "";
        
        $userInVoteExistObject = $voteRepository->findOneBy(
                array('user' => $userId, 'userkill' => $userSkillId)
            );

        // if($userInVoteExist && $userSkillInVoteExist)
        $voteEntity = new Vote();

        if($userInVoteExistObject)
        {
            $message1 = "Voto quitado";
            // $voteEntity = new Vote();
            $em->remove($userInVoteExistObject);
            $em->persist($voteEntity);
            $em->flush();
        }
        else
        {
            $message1 = "Voto agregado";
            // Instantiate Vote entity 
            //$voteEntity = new Vote();
            $voteEntity->setUserSkill($userSkill);
            $voteEntity->setUser($userVoting);
            $em->persist($voteEntity);
            $em->flush();
        }
        return new Response("Este Skill" . dump($userSkill) ."fue votado por". "::" . $message1 . dump($userInVoteExistObject));
    }

    /**
     * @Route("/send_email", name="send_email")
     * @Method("POST")
     */
    public function SendEmailAction(Request $request)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Mensaje de confirmación')
            ->setFrom('arkusnexus2015@gmail.com')
            ->setTo($request->get('email'))
            ->setBody($this->renderView(
                    'AppBundle:Security:message.html.twig',
                    array('token' => $request->get('token'))
                ),
                'text/html'
                );
        $this->get('mailer')->send($message);

        return $this->redirect($this->generateUrl('login_route'));
    }

    /**
     * @Route("/retrieve_password", name="retrieve_password")
     */
    public function PasswordPetitionAction()
    {
        return $this->render('AppBundle:Security:retrieve_password.html.twig');
    }

    /**
     * @Route("/ajax_skill", name="ajax_skill", options={"expose"=true})
     */
    public function ajaxSkills(Request $request)
    {
        $value = $request->get('term');
        $em = $this->getDoctrine()->getEntityManager();
        $skills = $em->getRepository('AppBundle:Skill')->findByComplete($value);

        $json = array();
        foreach ($skills as $skill) {
            $json[] = array(
                'label' => $skill->getName(),
                'value' => $skill->getSkillId()
            );
        }

        $response = new Response();
        $response->setContent(json_encode($json));

        return $response;
    }
}
