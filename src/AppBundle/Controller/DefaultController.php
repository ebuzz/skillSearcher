<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Entity\Skill;
use AppBundle\Entity\UserSkill;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     *
     * @Route("/register", name="register", options={"expose"=true})
     * @Method("GET")
     * @Template("default/register.html.twig")
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
            $user->setEmail($request->get('email'));
            $user->setFile($request->files->get('image'));
            $user->setPosition($position);
            $em->persist($user);
            $em->flush();
            $user->getUserId();


            if (!empty($skills)) {
                $this->AddSkills($skills,$user);
            }
        }
        return new Response();
    }

    private function AddSkills($skills,$user){
        foreach ($skills as $userSkill) {
            $em = $this->getDoctrine()->getManager();
            if ($userSkill["id"] == "") {
                $skillEntity = new Skill();
                $skillEntity->setName($userSkill["name"]);
                $em->persist($skillEntity);
                $skillEntity->getSkillId();

                $userSkillEntity = new UserSkill();
                $userSkillEntity->setSkill($skillEntity);
                $userSkillEntity->setUser($user);
                $em->persist($userSkillEntity);
                $em->flush();
            }
        }
    }
}
