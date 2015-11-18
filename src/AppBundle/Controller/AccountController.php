<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Account;
use AppBundle\Form\AccountType;

/**
 * Account controller.
 *
 * @Route("/account")
 */
class AccountController extends Controller
{

    /**
     * Lists all Account entities.
     *
     * @Route("/", name="account")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Account')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Account entity.
     *
     * @Route("/", name="account_create")
     * @Method("POST")
     * @Template("AppBundle:Account:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $account = new Account();
        
        $account->setName($request->get('name'));
        $account->setTechnologyDescription($request->get('technologyDescription'));
        $account->setLeaderName($request->get('leaderName'));
        $em     ->persist($account);
        $em     ->flush();

        return $this->redirectToRoute('account');
    }

    /**
     * Displays a form to create a new Account entity.
     *
     * @Route("/new", name="account_new")
     * @Method("GET")                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
     * @Template()
     */
    public function newAction()
    {
        $em             = $this->getDoctrine()->getManager();
        $entity         = $em->getRepository('AppBundle:Account')->findAll();
        $users          = $em->getRepository('AppBundle:User')->findAll();
        
        return array(
            'entity'    => $entity,
            'users'     => $users,
        );
    }

    /**
     * Finds and displays a Account entity.
     *
     * @Route("/{id}", name="account_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Account')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Account entity.
     *
     * @Route("/{id}/edit", name="account_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $account = $em->getRepository('AppBundle:Account')->find($id);
        $users   = $em->getRepository('AppBundle:User')->findAll();

        $error = " ";
        if (!$account) {
            $error = "true";
        }

        return array(
            'account'   => $account,
            'users'     => $users,
            'error'     => $error,
        );
    }

    /**
     * Edits an existing Account entity.
     *
     * @Route("/{id}", name="account_update")
     * @Method("POST")
     * @Template("AppBundle:Account:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $account = $em->getRepository('AppBundle:Account')->find($id);

        $account->setName($request->get('name'));
        $account->setTechnologyDescription($request->get('technologyDescription'));
        $account->setLeaderName($request->get('leaderName'));
        $em     ->persist($account);
        $em     ->flush();

        return $this->redirectToRoute('account');
    }
    /**
     * Deletes a Account entity.
     *
     * @Route("/{id}", name="account_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Account')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Account entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('account'));
    }

    /**
     * Creates a form to delete a Account entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('account_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
