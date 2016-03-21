<?php

namespace BDS\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BDSCalendarBundle:Default:index.html.twig', array('name' => $name));
    }
}
