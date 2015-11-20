<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class BaseController extends Controller
{
    /**
     * Get user logged
     * @return integer $userId
     */
    protected function getUserIdLogged()
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $this->get('security.token_storage')->getToken()->getUser()->getUserId();
        $userId = $em->getRepository('AppBundle:User')->find($userId)->getUserId();
        return $userId;
    }
}