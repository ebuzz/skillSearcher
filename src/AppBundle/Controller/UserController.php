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
use AppBundle\Form\UserType;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
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
     * Creates a new User entity.
     *
     * @Route("/", name="user_create")
     * @Method("POST")
     * @Template("AppBundle:User:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getUserId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     * @Route("/new", name="user_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
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

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'userSkills' => $userSkills,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($id);
        $userSkills = $user->getSkills();
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

        return array(
            'user'      => $user,
            'userSkills' => $userSkills,
            'accountsEntity' => $accountsEntity,
            'resultados' => $resultados,
            'accountList' => $accountList,
        );
    }    
    /**
     * Edits an existing User entity.
     *
     * @Route("/{id}", name="user_update", options={"expose"=true})
     * @Method("GET")
     * @Template("AppBundle:User:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
$em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);  
        $skillsRequest = $request->get('skills');
        $accounts = $request->get('account');
        // $date = date_create_from_format('Y-m-d', $request->get('admissionDate'));
        
        /**************** INICIO PROCESOS CON SKILLS ************************************/
        if (!empty($skillsRequest)) {       
            $skillsRequestId = [];
            foreach ($skillsRequest as $skillRequest) {
                $skillRequestId = $skillRequest['id'];
                array_push($skillsRequestId, $skillRequestId);
            }

            $userSkills = $user->getSkills();
            $allUserSkills = [];
            foreach ($userSkills as $userSkill) {
                $userSkillId = $userSkill->getSkill()->getSkillId();
                array_push($allUserSkills, $userSkillId);
            }
            $skillsId = array_diff($allUserSkills, $skillsRequestId);
            
            foreach ($skillsId as $skillId) {
                $userSkill_SkillsId = $em->getRepository('AppBundle:UserSkill')->findByskill($skillId);
                foreach ($userSkill_SkillsId as $userSkill_SkillId) {
                    $userSkill_UserId = $userSkill_SkillId->getUser()->getUserId();
                    $userSkill_Skill = $userSkill_SkillId->getSkill()->getSkillId();
                    
                    if($userSkill_UserId == $id && $userSkill_Skill == $skillId) {
                        $userSkill_UserSkillId = $em->getRepository('AppBundle:UserSkill')->findOneBy(array('user' => $userSkill_UserId, 'skill' => $userSkill_Skill));
                        $asd = $userSkill_UserSkillId->getUserSkillId();
                        $deleteUserSkill = $em->getRepository('AppBundle:UserSkill')->findOneByuserSkillId($asd);
                        $em->remove($deleteUserSkill);
                        $em->flush();
                    }     
                }     
            }

            foreach ($skillsRequest as $skillRequest) {
                $skillEntityByName = $em->getRepository('AppBundle:Skill')->findOneByName($skillRequest["name"]);
                if ($skillRequest["id"] == "" && is_null($skillEntityByName)) {
                    $skill = new Skill();
                    $skill->setName($skillRequest["name"]);                       
                    $em->persist($skill);
                    $em->flush();
                    $skill->getSkillId();
                    $userSkill = new userSkill();
                    $userSkill->setSkill($skill);
                    $userSkill->setUser($user);                       
                    $em->persist($userSkill);
                    $em->flush();
                } elseif ($skillEntityByName != "NULL") {
                    $Skill_SkillId = $skillEntityByName->getSkillId();
                    $userSkill_UserIdSkillId = $em->getRepository('AppBundle:UserSkill')->findOneBy(array('user' => $id, 'skill' => $Skill_SkillId));
                    if(empty($userSkill_UserIdSkillId)){
                        $userSkill = new userSkill();
                        $userSkill->setSkill($skillEntityByName);
                        $userSkill->setUser($user);                                   
                        $em->persist($userSkill);
                        $em->flush();
                    }
                }
            }
        } else {

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
        
        $user->setName($request->get('name'));
        $user->setLastName($request->get('lastname'));
        $user->setSurName($request->get('surname'));
        $user->setUserName($request->get('email'));
        $user->setPassword($request->get('password'));
        $user->setImage($request->get('image'));
        // $user->setAdmissionDate($date);

        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
    }
    /**
     * Deletes a User entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
