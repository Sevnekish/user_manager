<?php

namespace TK\UserManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class StaticPagesController extends Controller
{
    /**
     * Lists all User entities.
     *
     * @Route("/", name="home")
     * @Method("GET")
     * @Template()
     */
    public function homeAction()
    {
        return $this->render('TKUserManagerBundle:StaticPages:home.html.twig', array(
                // ...
            ));    }

}
