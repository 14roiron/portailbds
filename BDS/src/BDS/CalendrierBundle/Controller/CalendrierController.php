<?php

namespace BDS\CalendrierBundle\Controller;

use BDS\UserBundle\Entity\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use BDS\SportBundle\Entity\Sport;
use BDS\CalendrierBundle\Entity\Calendrier;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class CalendrierController extends Controller
{
	public function sportCalAction(Sport $domaine)
	{
	
		//on vérifie que l'utilisateur à accès à cette page
		
		//on charge la date actuelle 
		$now = new \DateTime();
		$now->setTime(0, 0, 0);
		
		//on récupère le lundi de la semaine
		$lundi = new \DateTime();
		$jsemaine = strftime('%u', $now->getTimestamp())-1; //-1 car le jour 0 st dimanche dans le php
		$lundi->setTime(0, 0, 0);
		$lundi->sub(new \DateInterval("P".$jsemaine."D"));
		
		//on tabule ls jours de la semaine
		$joursSemaine = array ();
		for ($i = 0; $i < 7; $i++)
		{
			$joursSemaine[$i] = new \DateTime();
			$joursSemaine[$i]->setTimestamp($lundi->getTimestamp());
			$joursSemaine[$i]->add(new \DateInterval("P".$i."D"));
		}
		
		$lundi = new \DateTime('04/25/2016');
		$dimanche = new \DateTime('04/30/2016');
		$cal = $domaine->getCalendrier();
		$events = $this->get('bds_calendrier.manager')->getbyDateIntervallCal($lundi, $dimanche, $cal);

	
		//on appelle le template
		return $this->render('BDSCalendrierBundle:Calendrier:sportCal.html.twig', array(
				'domaine'		=>	$domaine,
				'joursSemaine'	=>	$joursSemaine,
				'events'		=>	$events

		));
	}
	
	public function loadCalSportAction (Calendrier $cal, $date)
	{
		//si la date est null
		$now = new \DateTime();
		$now->setTime(0, 0, 0);
		if ($date = null){ $date = $now->getTimestamp(); }
		
		//on récupère le domaine
		$domaine = $this->get('bds_sport.manager')->getSport($cal->getNom());
	
		//on cherche lundi matin
		$lundi = new \DateTime();
		$jsemaine = strftime('%u', $date)-1; //-1 car le jour 0 st dimanche dans le php
		$lundi->setTime(0, 0, 0);
		$lundi->sub(new \DateInterval("P".$jsemaine."D"));
		
		//on cherche dimanche soir 
		$dimanche = new \DateTime();
		$dimanche->setTimestamp($lundi->getTimestamp());
		$dimanche->add(new \DateInterval("P".(7-$jsemaine)."D"));
		$dimanche->setTime(23, 59, 59);
		
	
		//on recupere les evenementscompris entre ces 2 date
		$events = $this->get('bds_calendrier.manager')->getbyDateIntervallCal($lundi, $dimanche, $cal);
		//$events = $this->get('bds_evenement.manager')->getAll();
		
		foreach ($events as $event)
		{
			$event->setCouleur($cal->getCouleur());
		}
		
		
	
		//on renvoit les infos au script
		$response = new Response($this->get('jms_serializer')->serialize($events, 'json', SerializationContext::create()->enableMaxDepthChecks()));
		return $response;
	
	}
	
	public function headerAction ( $date = null)
	{
		//on récupère la date d'aujourd'hui et la date cible 
		$now = new \DateTime();
		if($date == null){ $date = $now->getTimestamp();}
		$dateCible = new \DateTime();
		$dateCible->setTimestamp($date);
		
		//on récupère le lundi de la semaine
		$lundi = new \DateTime();
		$jsemaine = strftime('%u', $date)-1; //-1 car le jour 0 st dimanche dans le php
		$lundi->setTimestamp($date);
		$lundi->sub(new \DateInterval("P".$jsemaine."D"));
		
		//on tabule ls jours de la semaine 
		$joursSemaine = array ();
		for ($i = 0; $i < 7; $i++)
		{
			$joursSemaine[$i] = new \DateTime();
			$joursSemaine[$i]->setTimestamp($lundi->getTimestamp());
			$joursSemaine[$i]->add(new \DateInterval("P".$i."D"));
		}
		
		//lundi suivant et lundi precedent
		$lundiPrec = new \DateTime();
		$lundiPrec->setTimestamp($lundi->getTimestamp());
		$lundiPrec->sub(new \DateInterval("P7D"));
		$lundiSui = new \DateTime();
		$lundiSui->setTimestamp($lundi->getTimestamp());
		$lundiSui->add(new \DateInterval("P7D"));
		
		//on retourne la vue 
		return $this->render('BDSCalendrierBundle:Calendrier:header_content.html.twig', array(
				'now'			=>	$now,
				'joursSemaine'	=>	$joursSemaine,
				'lundiPrec'		=>	$lundiPrec,
				'lundiSui'		=>	$lundiSui,
				'dateCible'		=>	$dateCible
		));
		
	}
	
	public function nomJourSemaineAction ($date = null)
	{
		//on récupère la date d'aujourd'hui et la date cible
		$now = new \DateTime();
		if($date == null){ $date = $now->getTimestamp();}
		$dateCible = new \DateTime();
		$dateCible->setTimestamp($date);
		
		//on récupère le lundi de la semaine
		$lundi = new \DateTime();
		$jsemaine = strftime('%u', $date)-1; //-1 car le jour 0 st dimanche dans le php
		$lundi->setTimestamp($date);
		$lundi->sub(new \DateInterval("P".$jsemaine."D"));
		
		//on tabule ls jours de la semaine
		$joursSemaine = array ();
		for ($i = 0; $i < 7; $i++)
		{
			$joursSemaine[$i] = new \DateTime();
			$joursSemaine[$i]->setTimestamp($lundi->getTimestamp());
			$joursSemaine[$i]->add(new \DateInterval("P".$i."D"));
		}
		
		//on renvoit les infos au script
		$response = new Response($this->get('jms_serializer')->serialize($joursSemaine, 'json'));
		return $response;
	}
}
