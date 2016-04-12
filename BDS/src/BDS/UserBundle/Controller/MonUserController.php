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
	
	public function StatsAction (User $user=null)
	{
		//on récupère l'utilisateur
		if ($user == null) 
		{
			$user = $this->get('security.context')->getToken()->getUser();
				
			if (!is_object($user) || !$user instanceof UserInterface) 
			{
				throw new AccessDeniedException('This user does not have access to this section.');
			}
		}
		
		//pour chaque sport 
		$membres = $user->getMembres();
		$evenements = array();
		$participations = array();
		foreach ($membres as $membre)
		{
			$sport = $membre->getSport();
			
			//compter le nombre d'evenement depuis son inscripsion 
			$evenements[$sport->getNom()] = $this->get('bds_sport.manager')->getEvenementSince($sport, $membre->getInscripsion());
			
			//compter le nombre de participation (s'il n'est pas égal c'est qu'il y a un bug)
			$participations[$sport->getNom()] = array();
			
			//faire l'inventaire des oui, non, peut-être
			$participations[$sport->getNom()][2] = 0;
			$participations[$sport->getNom()][1] = 0;
			$participations[$sport->getNom()][0] = 0;
			foreach ($membre->getParticipations() as $participation)
			{
				switch ($participation->getParticipation())
				{
					case null:
						$participations[$sport->getNom()][2]++;
						break;
					case true:
						$participations[$sport->getNom()][1]++;
						break;
					case false:
						$participations[$sport->getNom()][0]++;
						break;
				}
			}
		}
		
		//on retourne à la vue
		return $this->render('BDSUserBundle:Profile:stats.html.twig', array(
				'user'				=>	$user,
				'membres'			=>	$membres,
				'evenements'		=>	$evenements,
				'participations'	=>	$participations,
		));
		
	}
}