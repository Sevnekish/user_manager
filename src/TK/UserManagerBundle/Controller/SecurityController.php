<?php

namespace TK\UserManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller {
    /**
     * Display a form to create a new Session
     *
     * @Route("/signin", name="_security_login")
     * @Method("GET")
     * @Template()
     */
    public function loginAction(Request $request ) {
        if($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('home'));
        }
        $session = $request->getSession();

        // get the login error if there is one
        $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);

        
        return array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error_pass' => $error
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }

}

/**
 * Create a new Session
 *
 * @Route("/login_check", name="_security_check")
 * @Method("POST")
 * @Template()
 */
// public function loginCheckAction() {

// }

/**
 * Destroy Session
 *
 * @Route("/logout", name="_security_logout")
 * @Method("GET")
 * @Template()
 */
// public function logoutAction() {
    
// }