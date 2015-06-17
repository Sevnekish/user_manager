<?php

namespace TK\UserManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SessionsController extends Controller {
    /**
     * Display a form to create a new Session
     *
     * @Route("/signin", name="session_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        return $this->render('TKUserManagerBundle:StaticPages:home.html.twig', array(
                // ...
            ));
    }

    /**
     * Create a new Session
     *
     * @Route("/signin", name="session_create")
     * @Method("POST")
     * @Template()
     */
    public function createction() {
        return $this->render('TKUserManagerBundle:StaticPages:home.html.twig', array(
                // ...
            ));
    }

    /**
     * Destroy Session
     *
     * @Route("/logout", name="session_destroy")
     * @Method("GET")
     * @Template()
     */
    public function destroyAction() {
        return $this->render('TKUserManagerBundle:StaticPages:home.html.twig', array(
                // ...
            ));
    }

}