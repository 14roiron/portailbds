<?php

namespace BDS\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BDSImageBundle:Default:index.html.twig', array('name' => $name));
    }
}
