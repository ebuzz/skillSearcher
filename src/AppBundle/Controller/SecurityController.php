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

class SecurityController extends Controller
{
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
}
