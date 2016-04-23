<?php

namespace BDS\CanlendrierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BDSCanlendrierBundle:Default:index.html.twig', array('name' => $name));
    }
}
