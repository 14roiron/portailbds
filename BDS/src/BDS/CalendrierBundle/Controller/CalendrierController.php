<?php

namespace BDS\CalendrierBundle\Controller;

use BDS\UserBundle\Entity\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use BDS\SportBundle\Entity\Sport;
use Symfony\Component\HttpFoundation\JsonResponse;

class CalendrierController extends Controller
{
	public function sportCalAction(Sport $domaine, $annee=null, $mois=null, $jour=null)
	{
	
		//on vérifie que l'utilisateur à accès à cette page
	
		//on récupère touts les évènements (filtre à bosser en fx de l'utilisateur, ce sera le même que dans aside)
		$events = $domaine->getCalendrier()->getEvenements();
		//trouver un moyen de faire le tri
		
		//on charge la date actuelle 
		$now = new \DateTime();
		
		//si l'année/mois/jours n'est pas préscisé on affecte l'annee/mois/jours en cours
		if($annee == null){ $annee = $now->format('Y');	}
		if($mois == null){ $mois = $now->format('m'); }
		if($jour == null){ $jour = $now->format('d'); }
		
		//on met le mois courant en lettre 
		$moisLet = strftime("%b", strtotime($mois."/".$jour."/".$annee));
		
		//on donne les jours de la semaine
		$jours = $this->get('bds_evenement.manager')->getJourSemaine();
		
		//on fait un tableau contenant toute les dates à afficher
		$listDate = $this->get('bds_evenement.manager')->getDate($annee, $annee);
	
		//on appelle le template
		return $this->render('BDSCalendrierBundle:Calendrier:sportCal.html.twig', array(
				'events'	=>	$events,
				'domaine'	=>	$domaine,
				'jours'		=>	$jours,
				'listDate'	=>	$listDate,
				'annee'		=>	$annee,
				'mois'		=>	$mois,
				'jour'		=>	$jour,
				'moisLet'	=>	$moisLet,
				'now'		=>	$now
		));
	}
	
	public function loadCalSportAction (Calendrier $cal, $day)
	{
		//on récupère le domaine
		$domaine = $this->get('bds_sport.manager')->getSport($cal->getNom());
		
		//on cherche la semaine en cours
		$day = new DateTime($day);
		$lundi = $day - (DateTime(strftime('%u', $day->getTimestamp())*24*60*60));
		$dimanche = $day + (DateTime((7 - strftime('%u', $day->getTimestamp()))*24*60*60));
		
		//on recupere les evenementscompris entre ces 2 date 
		$events = $this->get('bds_evnement.manager')getbyDateIntervallCal($lundi, $dimanche, $cal);
		
		//on renvoit les infos au script 
		$reponse = new JsonResponse();
		$response->setDate(array(
			'lundi'		=>	$lundi,
			'events'	=>	$events,
			
			));
			
		return $response;
		
	}
}
