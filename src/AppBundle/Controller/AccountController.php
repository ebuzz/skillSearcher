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

        $account = $em->getRepository('AppBundle:Account')->findAll();

        return array(
            'accounts' => $account,
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
        $users          = $em->getRepository('AppBundle:User')->findAll();
        
        return array(
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

        $account = $em->getRepository('AppBundle:Account')->find($id);

        if (!$account) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        return array(
            'account'      => $account,
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
     * @Route("/{id}/update", name="account_update")
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
     * @Route("/{id}/delete", name="account_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Account')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Account entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('account');
    }
}
