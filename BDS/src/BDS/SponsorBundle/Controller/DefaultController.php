<?php

namespace BDS\SponsorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BDSSponsorBundle:Default:index.html.twig', array('name' => $name));
    }
}
