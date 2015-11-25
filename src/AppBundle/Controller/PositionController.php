<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Position;

/**
 * Position controller.
 *
 * @Route("/position")
 */
class PositionController extends Controller
{
    /**
     * Lists all Position entities.
     *
     * @Route("/", name="position")
     * @Template("AppBundle:Position:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $positions = $em->getRepository('AppBundle:Position')->findAll();
        return array(
            'positions' => $positions,
        );
    }

    /**
     * Displays a form to create a new Position entity.
     *
     * @Route("/new", name="position_new")
     * @Template()
     */
    public function newAction()
    {
        return $this->render('AppBundle:Position:new.html.twig');
    }

    /**
     * Creates a new Position entity.
     *
     * @Route("/create", name="position_create")
     * @Method("POST")
     * @Template("AppBundle:Position:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $position = new Position();

        $position ->setName($request->get('name'));
        $em       ->persist($position);
        $em       ->flush();

        return $this->redirectToRoute('position');
    }

    /**
     * Displays a form to edit an existing Position entity.
     *
     * @Route("/{id}/edit", name="position_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $position = $em->getRepository('AppBundle:Position')->find($id);

        $error = " ";
        if (!$position) {
            $error = "true";
            return $this->redirectToRoute('position', array(
                'error'     => $error,
                )); 
        }

        return array(
            'position'   => $position,
            'error'     => $error,
        );
    }

    /**
     * Edits an existing Position entity.
     *
     * @Route("/{id}/update", name="position_update")
     * @Method("POST")
     * @Template("AppBundle:Position:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $position = $em->getRepository('AppBundle:Position')->find($id);

        $position->setName($request->get('name'));
        $em     ->persist($position);
        $em     ->flush();

        return $this->redirectToRoute('position');
    }
    /**
     * Deletes a Position entity.
     *
     * @Route("/{id}/delete", name="position_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $position = $em->getRepository('AppBundle:Position')->find($id);
        if (!$position) {
            throw $this->createNotFoundException('Unable to find position selected.');
        }
        $em->remove($position);
        $em->flush();
        return $this->redirectToRoute('position');
    }
}