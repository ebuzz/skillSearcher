<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\User;
use AppBundle\Entity\UserSkill;
use AppBundle\Entity\Skill;
use AppBundle\Entity\Account;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends BaseController
{

    /**
     *
     * @Route("/profile/{id}", name="user_profile")
     * @Method("GET")
     * @Template("AppBundle:User:view_profile.html.twig")
     */
    public function showProfileAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        $userLogged = $this->getUserIdLogged();

        return array(
            'user' => $user,
            'userLogged' => $userLogged,
        );
    }

    /**
     * Lists all User entities.
     *
     * @Route("/", name="user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:User')->findAll();
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}/show", name="user_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:User')->find($id);
        $userSkills = $entity->getSkills();
        if (!$entity) {
            throw $this->createNotFoundException('No existe la entidad de usuario.');
        }
        return array(
            'entity' => $entity,
            'userSkills' => $userSkills,
        );
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        $userLogged = $this->getUserIdLogged();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_RH')) {
            if ($userLogged != $id) {
                return $this->redirectToRoute('homepage');
            }
        }

        $userSkills = $user->getSkills();
        $position = $em->getRepository('AppBundle:Position')->findAll();
        $accountsEntity = $em->getRepository('AppBundle:Account')->findAll();
        $accounts = [];
        foreach ($accountsEntity as $accountEntity) {
            $accountId = $accountEntity->getAccountId();
            array_push($accounts, $accountId);
        }

        $accountList = [];
        $userAccounts = $user->getAccounts();
        foreach ($userAccounts as $userAccount) {
            $userAccount = $userAccount->getAccountId();
            array_push($accountList, $userAccount);
        }
        $resultados = array_diff($accounts, $accountList);
        if (!$user) {
            throw $this->createNotFoundException('No existe la entidad de usuario.');
        }
        $userPosition = $user->getPosition();

        $roles = array(
            0 => array(
                'id' => 'ROLE_USER',
                'name' => 'Colaborador'
            ),
            1 => array(
                'id' => 'ROLE_RH',
                'name' => 'Recursos Humanos'
            ),
            2 => array(
                'id' => 'ROLE_ADMIN',
                'name' => 'Administrador'
            )
        );

        $flag = ($request->get('flag'));

        return array(
            'user' => $user,
            'userSkills' => $userSkills,
            'accountsEntity' => $accountsEntity,
            'resultados' => $resultados,
            'accountList' => $accountList,
            'userPosition' => $userPosition,
            'positions' => $position,
            'roles' => $roles,
            'flag' => $flag,
        );
    }

    /**
     * Edits an existing User entity.
     *
     * @Route("/{id}/update", name="user_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppBundle:User:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        $skillsRequest = $request->get('skills');
        $accounts = $request->get('account');
        $dateAdmission = $request->get('admissionDate');
        $password = $request->get('password');
        $image = $request->files->get('image');
        $position = $em->getRepository('AppBundle:Position')->find($request->get('position'));

        $userSkillArray = $user->getSkills();
            $skillsArray = [];
            foreach ($userSkillArray as $us) {
                $userSkillName = $us->getSkill()->getName();
                array_push($skillsArray, $userSkillName);
            }

        /**************** INICIO PROCESOS CON SKILLS ************************************/
        if (!empty($skillsRequest)) {
            $skillsRequestId = [];
            foreach ($skillsRequest as $skill) {
                $name = $skill['name'];
                array_push($skillsRequestId, $name);
            }
            $addSkill = array_diff($skillsRequestId, $skillsArray);
            $removeSkills = array_diff($skillsArray, $skillsRequestId);

            foreach ($skillsRequestId as $skill) {
                $skillEntityToManage = $em->getRepository('AppBundle:Skill')->findOneByName($skill)->getSkillId();
                $foundHiddenSkill = $em->getRepository('AppBundle:UserSkill')->findIdToManage($id, $skillEntityToManage);
                if(!empty($foundHiddenSkill)) {
                    $userSkill = $foundHiddenSkill[0];
                    if($userSkill->getIsActive() == 0) {
                            $userSkill->setIsActive(1);
                            $em->persist($userSkill);
                            $em->flush();
                        }
                }
            }

            if (!empty($addSkill)) {
                foreach ($addSkill as $add) {
                    $skillEntityByName = $em->getRepository('AppBundle:Skill')->findOneByName($add);
                    if (is_null($skillEntityByName)) {
                        $s = new Skill();
                        $s ->setName($add);
                        $em->persist($s);
                        $em->flush();
                        $s->getSkillId();
                        $userSkill = new UserSkill();
                        $userSkill->setSkill($s);
                        $userSkill->setUser($user);
                        $userSkill->setIsActive(1);
                        $em->persist($userSkill);
                        $em->flush();
                    }
                    else{
                        $userSkill = new UserSkill();
                        $userSkill->setSkill($skillEntityByName);
                        $userSkill->setUser($user);
                        $userSkill->setIsActive(1);
                        $em->persist($userSkill);
                        $em->flush();
                    }
                }
            }
            if (!empty($removeSkills)) {
                foreach ($removeSkills as $remove) {
                    $skillEntityToRemove = $em->getRepository('AppBundle:Skill')->findOneByName($remove)->getSkillId();
                    $foundUserSkill = $em->getRepository('AppBundle:UserSkill')->findIdToManage($id, $skillEntityToRemove);
                    $userSkill = $foundUserSkill[0];
                    $userSkill->setIsActive(0);
                    $em->persist($userSkill);
                    $em->flush();
                }
            }
        }
        else {
            foreach ($skillsArray as $skill) {
                $skillEntityToRemove = $em->getRepository('AppBundle:Skill')->findOneByName($skill)->getSkillId();
                $foundUserSkill = $em->getRepository('AppBundle:UserSkill')->findIdToManage($id, $skillEntityToRemove);
                $userSkill = $foundUserSkill[0];
                $userSkill->setIsActive(0);
                $em->persist($userSkill);
                $em->flush();
            }
        }
        /****************FIN PROCESOS CON SKILLS ************************************/

        /*************** INICIO PROCESOS DE CUENTAS ******************************/
        if (!empty($accounts)) {
            $userAccounts = $user->getAccounts();
            foreach ($userAccounts as $userAccount) {
                $user->removeAccount($userAccount);
                $em->persist($user);
                $em->flush();
            }
            foreach ($accounts as $requestAccount) {
                $account_AccountId = $em->getRepository('AppBundle:Account')->find($requestAccount);
                $user->addAccount($account_AccountId);
            }
        } else {
            $userAccounts = $user->getAccounts();
            foreach ($userAccounts as $userAccount) {
                $user->removeAccount($userAccount);
                $em->persist($user);
                $em->flush();
            }
        }
        /*************** FIN PROCESOS CON CUENTAS ********************************/

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $user->setRoles($request->get('role'));
        }

        $user->setName($request->get('name'));
        $user->setLastName($request->get('lastname'));
        $user->setSurName($request->get('surname'));
        $user->setUserName($request->get('email'));
        if ($image != "") {
            $user->setFile($request->files->get('image'));
        }
        if ($password != "") {
            $user->setPassword($password);
        }
        if (!empty($dateAdmission)) {
            $dateAdmission = date_create_from_format('Y-m-d', $dateAdmission);
            $user->setAdmissionDate($dateAdmission);
        }
        if ($position != "") {
            $user->setPosition($position);
        }
        $em->persist($user);
        $em->flush();
        return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        // return new Response(dump($skillsArray));
        // return new Response(dump($deleteUserSkill));
        // return new Response(dump($user));
    }


    /**
     * @Route("/verify_skill", name="verify_skill", options={"expose"=true})
     */
    public function verifySkills(Request $request)
    {
        $value = $request->get('term');
        $em = $this->getDoctrine()->getEntityManager();
        $skills = $em->getRepository('AppBundle:Skill')->completeSkill($value);

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

    /**
     * Deletes a User entity.
     *
     * @Route("/{id}/delete", name="user_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find user selected.');
        }
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('user');
    }
}