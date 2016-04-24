<?php

namespace BDS\CalendrierBundle\Controller;

use BDS\UserBundle\Entity\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CalendrierController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BDSCalendrierBundle:Default:index.html.twig', array('name' => $name));
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
    
    public function ListAction()
    {
    	//on recupere l'utiisateur courant et on s'assure qu'il est autorisé à accéder à cette page 
    	$user = $this->get('security.context')->getToken()->getUser();
    	
    	if (!is_object($user) || !$user instanceof UserInterface) {
    		throw new AccessDeniedException('This user does not have access to this section.');
    	}
    	
    	//on récupère les calendriers de l'utilisateur 
    	$calendriers = $user->getCalendriers();
    	
    	//on renvoit la vue 
    	return $this->render('BDSCalendrierBundle:calendrier:list.html.twig', array(
    			'user'			=>	$user,
    			'calendriers'	=>	$calendriers
    	));
    	
    
    	
    	
    }
}
