<?php

namespace BDS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use BDS\UserBundle\Entity\User;

class MonUserController  extends Controller
{
	public function MessageAction(User $user)
	{
		$messageList = null;
		//$messageList = $this->get('bds_user.manager')->getMessages($user);
		
		return $this->render('BDSUserBundle:monUser:message.html.twig', array(
				'messageList'	=>	$messageList,
				'user'			=>	$user
		));
	}
}