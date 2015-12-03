<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * @Route("/login")
*/
class SecurityController extends Controller
{
    /**
     * @Route("/", name="login_route")
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
     * @Route("_check", name="login_check")
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
        $random = openssl_random_pseudo_bytes(24, $cstrong);
        $nip  = bin2hex($random);
        $expDate = new \DateTime();
        $expDate->format('Y-m-d H:i:s');

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(array(
            'username' => $request->get('email')
            ));

        if (empty($user)) {
            return $this->render('AppBundle:Security:retrieve_password.html.twig', array(
                'blank' => 'blank',
            ));
        }
        
        $token = new Token();
        $token->setTokenId($nip);
        $token->setExpDate($expDate);
        $token->setUserId($user);
        $em->persist($token);
        $em->flush();

        // die($token);
        $message = \Swift_Message::newInstance()
            ->setSubject('Mensaje de confirmación')
            ->setFrom('arkusnexus2015@gmail.com')
            ->setTo($request->get('email'))
            ->setBody($this->renderView(
                    'AppBundle:Security:message.html.twig',
                    array(  'nip' => $nip,
                            'id'=> $user->getUserId())
                ),
                'text/html'
                );
        $this->get('mailer')->send($message);

        return $this->redirect($this->generateUrl('login_route'));
    }

    /**
     * @Route("/retrieve_password", name="retrieve_password")
     * @Method("GET")
     */
    public function PasswordPetitionAction(Request $request)
    {
        $error = " ";
        if($request->get('error'))
        {
            $error = $request->get('error');
            return $this->render('AppBundle:Security:retrieve_password.html.twig', array(
                'error' => $error,
                ));
        }
        return $this->render('AppBundle:Security:retrieve_password.html.twig', array(
                'error' => $error,
                ));
    }

    /**
     * @Route("/set_password", name="set_password")
     * @Method("POST")
     * @Template("AppBundle:Security:change_password.html.twig")
     */
    public function SetPasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder('t')
             ->select('t.tokenId')
             ->from('AppBundle:Token', 't')
             ->where('t.userId = :id')
             ->setParameter('id', $request->get('id'))
             ->getQuery();

        $tokenArr = $qb->getResult();
        if($tokenArr == null)
        {
            $error = 'alert';
            return $this->redirectToRoute('retrieve_password', array(
                        'error' => $error,
                        ));
        }
        $tokenElement = $tokenArr["0"];
        $tokenId = $tokenElement["tokenId"];

        if($tokenId != $request->get('nip'))
        {
            $error = 'warning';
            return $this->redirectToRoute('retrieve_password', array(
                    'error' => $error,
                    ));
        }
        if($request->get('password') != $request->get('confirm_password'))
        {
            $alert = 'alert';
            return array(
                    'error' => $alert,
                    );
        }
        
        else
        {
            $em = $this->getDoctrine()->getManager();
                $user = $em->getRepository('AppBundle:User')->find($request->get('id'));
                $user->setPassword($request->get('password'));
                $em->persist($user);
                $em->flush();
        
                $tokenSelected = $em->getRepository('AppBundle:Token')->find($request->get('nip'));
                $em->remove($tokenSelected);
                $em->flush();
        }
        
        return $this->redirect($this->generateUrl('login_route'));
    }

    /**
     * @Route("/change_password", name="change_password")
     * @Method("GET")
     */
    public function ChangePasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $token = $em->getRepository('AppBundle:Token')->findAll();

        $dateNow = new \DateTime();
        $dateNow->sub( new \DateInterval('PT15M'));

        if($token)
        {
            foreach ($token as $list)
            {
                if($dateNow >= $list->getExpDate())
                {
                    $tokenSelected = $em->getRepository('AppBundle:Token')->find($list->getTokenId());
                    $em->remove($tokenSelected);
                    $em->flush();
                }
            }
        }
        $id = $request->get('id');
        $nip = $request->get('nip');

        return $this->render('AppBundle:Security:change_password.html.twig', array(
            'id' => $id,
            'nip' => $nip
            ));
    }
}
