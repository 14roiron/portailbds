<?php

namespace BDS\CalendrierBundle\Controller;

use BDS\UserBundle\Entity\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use BDS\SportBundle\Entity\Sport;
use BDS\CalendrierBundle\Entity\Calendrier;
use Symfony\Component\HttpFoundation\JsonResponse;

class CalendrierController extends Controller
{
	public function sportCalAction(Sport $domaine)
	{
	
		//on vérifie que l'utilisateur à accès à cette page
		
		//on charge la date actuelle 
		$now = new \DateTime();
		
		//on fait un tableau contenant toute les dates à afficher
		$joursSemaine = array ();
		$lundi = new \DateTime();
		//$jsemaine = strftime('%u', $now->getTimestamp());
		$lundi->setTime(0, 0, 0);
		
		for ($i = 0; $i < 7; $i++)
		{
			$joursSemaine[$i] = $lundi;
			$joursSemaine[$i]->add(new \DateInterval(("P".$i."D")));
		}
	
		//on appelle le template
		return $this->render('BDSCalendrierBundle:Calendrier:sportCal.html.twig', array(
				'joursSemaine'	=>	$joursSemaine,
				'domaine'		=>	$domaine,
				'now'			=>	$now,
				'lundi'			=>	$lundi,
		));
	}
	
	public function loadCalSportAction (Calendrier $cal, $day)
	{
		//on récupère le domaine
		$domaine = $this->get('bds_sport.manager')->getSport($cal->getNom());
	
		//on cherche la semaine en cours
		$day = new \DateTime($day);
		$lundi = $day - (DateTime(strftime('%u', $day->getTimestamp())*24*60*60));
		$dimanche = $day + (DateTime((7 - strftime('%u', $day->getTimestamp()))*24*60*60));
	
		//on recupere les evenementscompris entre ces 2 date
		//$events = $this->get('bds_evnement.manager')getbyDateIntervallCal($lundi, $dimanche, $cal);
	
		//on renvoit les infos au script
		$response = new JsonResponse();
		$response->setDate(array(
				'lundi'		=>	$lundi,
				//'events'	=>	$events,
					
		));
			
		return $response;
	
	}
}
