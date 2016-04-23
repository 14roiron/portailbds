<?php

namespace BDS\CanlendrierBundle\Controller;

use BDS\UserBundle\Entity\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CalendrierController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BDSCanlendrierBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function DashboardAction()
    {
    	$user = $this->get('security.context')->getToken()->getUser();
    		
    	if (!is_object($user) || !$user instanceof UserInterface) {
    		throw new AccessDeniedException('This user does not have access to this section.');
    	}
    	
    	return $this->render('BDSCalendrierBundle:calendrier:dashboard.html.twig', array(
    			'user'	=>	$user
    	));
    }
}
