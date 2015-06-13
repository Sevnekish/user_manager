<?php

namespace TK\UserManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StaticPagesController extends Controller
{
    public function homeAction()
    {
        return $this->render('TKUserManagerBundle:StaticPages:home.html.twig', array(
                // ...
            ));    }

}
