<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Entity\UserSkill;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Skill;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * Gets all users with its skills.
     *
     * @Route("/busqueda",name="search_user")
     * @Method("GET")
     * @Template("AppBundle:User:searchuser.html.twig")
     */
    public function getUsersWithSkillsAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $userRepository = $em->getRepository('AppBundle:User');
        $accountRepository = $em->getRepository('AppBundle:Account');

        $allUsers = $userRepository->findAll();
        $allAccounts = $accountRepository->findAll();

        return array(
            'allUsers' => $allUsers,
            'allAccounts' => $allAccounts,
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

        if (!$user) {
            throw $this->createNotFoundException('No existe la entidad de usuario.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'user'      => $user,
            'userSkills' => $userSkills,
            'delete_form' => $deleteForm->createView(),
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
        
        $skills = $request->get('skills');
        $date = date_create_from_format('Y-m-d', $request->get('admissionDate'));
  

        foreach ($skills as $userSkill) {
            if ($userSkill["id"] == "")
            {
                $skill = new Skill();
                $skill->setName($userSkill["name"]);
                $em->persist($skill);
                $em->flush();

                $skill->getSkillId();
                $userSkills = new userSkill();
                $userSkills->setSkill($skill);
                $userSkills->setUser($user);
                $em->persist($userSkills);
                $em->flush();
            }
        }
      
        $user->setName($request->get('name'));
        $user->setLastName($request->get('lastname'));
        $user->setSurName($request->get('surname'));
        $user->setUsername($request->get('email'));
        $user->setPassword($request->get('password'));
        $user->setImage($request->get('image'));
        $user->setAdmissionDate($date);


        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('user_show', array('id' => $id)));
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
