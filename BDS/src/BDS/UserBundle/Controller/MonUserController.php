<?php

namespace BDS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use BDS\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MonUserController  extends Controller
{
	public function MessageAction(User $user=null)
	{
		if( $user == null ) {
			$user = $this->get('security.context')->getToken()->getUser();
			
			if (!is_object($user) || !$user instanceof UserInterface) {
			 throw new AccessDeniedException('This user does not have access to this section.');
			 }
		}
		
		//on recupere tous les messages et on les trie par date 
		$messageList = $user->getMessages();
		$messageList = $this->get('bds_user.manager')->triDate($messageList);
		
		return $this->render('BDSUserBundle:monUser:message.html.twig', array(
				'messageList'	=>	$messageList,
				'user'			=>	$user
		));
	}
}