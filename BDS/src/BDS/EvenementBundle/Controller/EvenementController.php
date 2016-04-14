<?php

namespace BDS\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\EvenementBundle\Entity\Evenement;
use BDS\EvenementBundle\Form\EvenementType;
use BDS\SportBundle\Entity\Sport;
use BDS\EvenementBundle\Entity\Participation;
use BDS\EvenementBundle\Form\MAJEvenementType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EvenementController extends Controller
{

	public function indexAction (Sport $domaine, $page)
	{
		//si la page est inferieur à 1, pas la peine de l'afficher
		if ($page < 1)
		{
			throw new NotFoundHttpException('page "'.$page.'" inexistante');
		}
		
		//on vérifie que l'utilisateur à accès à cette page 
		
		//on récupère touts les évènements
		$listEvents = $domaine->getEvenements();
		
		//trouver un moyen de faire le tri 
		
		//on appelle le template 
		return $this->render('BDSEvenementBundle:Evenement:index.html.twig', array(
				'listEvents'	=>	$listEvents,
				'domaine'		=>	$domaine
		));
		
	}
	
	/**
	 * @ParamConverter("domaine", options={"mapping": {"nom": "nom"}})
	 * @ParamConverter("evenement", options={"mapping": {"id": "id"}})
	 */
	public function viewAction ($affichage, Sport $domaine, Evenement $evenement, Request $request)
	{
		
		//on récupère la liste des participations pour donner des noms au labels du formulaire
		$listParticipations = $evenement->getParticipations();
		
		//on creer le formulaire géant 
		$form = $this->createForm(new MAJEvenementType(),	$evenement);
		
		//on fait le lien requete formulaire 
		$form->handleRequest($request);
		
		//on passe par une étape de validation des données 
		if ($form->isValid())
		{
			/*
			 * on sauvegarde l'évenement, 
			 * normalement la persistence en cascade devrait 
			 * permettre de mettre à jour les participations 
			 */
			$this->get('bds_evenement.manager')->save($evenement);
			
			$request->getSession()->getFlashBag()->add('notice', "l'évènement a été mis à jour");
			
			//on affiche la nouvelle page de l'évènement 
			return $this->redirect($this->generateUrl('bds_evenement_view', array(
					'nom'	=>	$domaine->getNom(),
					'id'		=> 	$evenement->getId()
			)));
		}
		//deux affichage possibles 
		if ($affichage == "liste"){

			return $this->render('BDSEvenementBundle:Evenement:view.html.twig', array(
					'domaine' 	=>	$domaine,
					'evenement'	=>	$evenement,
					'form'		=>	$form->createView(),
					'objParticipations'	=>	$listParticipations
					
			));
		} 
		elseif ($affichage == "drag_n_drop")
		{
			$participationOui = $this->get('bds_participation.manager')->getParticipation($listParticipations, TRUE);
			$participationNon = $this->get('bds_participation.manager')->getParticipation($listParticipations, FALSE);
			$participationAucun = $this->get('bds_participation.manager')->getParticipation($listParticipations, NULL);
			
			return $this->render('BDSEvenementBundle:Evenement:drag.html.twig', array(
					'domaine' 			=>	$domaine,
					'evenement'			=>	$evenement,
					'form'				=>	$form->createView(),
					'objParticipations'	=>	$listParticipations,
					'participationOui'	=>	$participationOui,
					'participationNon'	=>	$participationNon,
					'participationAucun'=>	$participationAucun
						
			));
		}
	}
	
	public function addAction (Sport $domaine, Request $request)
	{
		//verifier que le visiteur a le droit d'acceder à cette page
		
		//on crée un objet Evenement 
		$evenement = new Evenement();
		
		//on crée le formulaire 
		$form = $this->createForm(new EvenementType(), $evenement);

		//on fait le lien requete formulaire 
		$form->handleRequest($request);
		
		/*
		 * si les champs complémentaires n'ont pas été rempli on
		 * charge une date de fin et de début des inscripsion pour éviter les inscripsions sauvages
		 * 2 mois après
		 */
		if ($evenement->getDebutInscripsion() == NULL)
		{
			$evenement->setDebutInscripsion(new \DateTime());
		}
			
		if ($evenement->getFinInscripsion() == NULL)
		{
			$evenement->setFinInscripsion($evenement->getDebutEvenement());
		}
			
		
		//on passe par une étape de validation 
		if($form->isValid())
		{	
			//on parcour chaque sport de l'évenement 
			$sports = $evenement->getSports();
			
			foreach ($sports as $sport)
			{
				//on ajoute la participation de tous les membres de l'équipe
				$membres = $sport->getMembres();
				
				foreach ($membres as $membre)
				{
					//on crée une nouvelle participation 
					$participation = new Participation();
					
					//on l'hydrate 
					$participation->setMembre($membre);
					$participation->setEvenement($evenement);
					
					//on sauvegarde la participation
					$this->get('bds_participation.manager')->save($participation);
				}
				
				//on enregistre l'objet dans la bdd
				$this->get('bds_evenement.manager')->save($evenement);
			}
			
			$request->getSession()->getFlashBag()->add('success', 'Evenement'. $evenement->getNom().' bien enregistré.');
			
			//on affiche la page du nouvel évenement
			return $this->redirect($this->generateUrl('bds_evenement_view', array(
					'nom'	=>	$domaine->getNom(),
					'id'		=> $evenement->getId()
			)));
		}
			
			//on passe le formulaire à la vue
			return $this->render('BDSEvenementBundle:Evenement:add.html.twig', array(
					'domaine'	=>	$domaine,
					'form'		=>$form->createView()
			));
			
	}
	/**
	 * @ParamConverter("domaine", options={"mapping": {"nom": "nom"}})
	 * @ParamConverter("evenement", options={"mapping": {"id": "id"}})
	 */
	public function editAction (Sport $domaine, Evenement $evenement, Request $request)
	{
		//verifier que le visiteur a le droit d'acceder à cette page
		
		//on crée le formulaire 
		$form = $this->createForm(new EvenementType(), $evenement);

		//on fait le lien requete formulaire 
		$form->handleRequest($request);
		
		//on passe par une étape de validation 
		if($form->isValid())
		{
			//on enregistre l'objet dans la bdd
			$this->get('bds_evenement.manager')->save($evenement);
			
			$request->getSession()->getFlashBag()->add('success', 'Evenement '.$evenement->getNom().' bien enregistré.');
			
			//on affiche la page du nouvel évenement
			return $this->redirect($this->generateUrl('bds_evenement_view', array(
					'nom'	=>	$domaine->getNom(),
					'id'		=> $evenement->getId()
			)));
		}
			
			//on passe le formulaire à la vue
			return $this->render('BDSEvenementBundle:Evenement:add.html.twig', array(
					'domaine'	=>	$domaine,
					'form'		=>$form->createView()
			));
		
	}
	/**
	 * 
	 * @ParamConverter("domaine", options={"mapping": {"nom": "nom"}})
	 * @ParamConverter("evenement", options={"mapping": {"id": "id"}})
	 */
	public function deleteAction (Sport $domaine, Evenement $evenement, Request $request)
	{
		
		//on supprime l'objet de la base de donnée 
		$this->get('bds_evenement.manager')->deleteEvenement($evenement);
		
		//on fait un flag
		$request->getSession()->getFlashBag()->add('success', "l'Evenement ".$evenement->getNom().' a été supprimé.');
		
		//on revient à la page de gestion capitaine
		return $this->redirect($this->generateUrl('bds_capitaine_evenement', array(
				'nom'	=>	$domaine->getNom()
		)));
	}
	
	public function calendarAction (Sport $domaine)
	{
		//on se place dans le bon domaine
		//$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on affiche le calendrier (on s'interessera plus tard au visiteur)
		return $this->render('BDSEvenementBundle:Evenement:calendrier.html.twig', array(
				'domaine'	=> $domaine
		));
	}
	
	
	public function asideAction ( $domaine, $annee = null)
	{
		//on récupère l'année courante 
		if ($annee == null)
		{
			$annee = date('Y');
		}
		
		//on se place dans le bon domaine 
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on récupère touts les évènements (filtre à bosser en fx de l'utilisateur, ce sera le même que dans aside)
		$listEvents = $domaine->getEvenements();
		//trouver un moyen de faire le tri 
		
		//on donne les mois de l'année 
		$listMois = $this->get('bds_evenement.manager')->getMois();
		//on fait un tableau contenant toute les dates à afficher 
		$listDate = $this->get('bds_evenement.manager')->getDate($annee, $annee);
		
		
		//on appelle le template 
		return $this->render('BDSEvenementBundle:Evenement:aside.html.twig', array(
				'listEvents'	=>	$listEvents,
				'domaine'		=>	$domaine,
				'listMois'		=>	$listMois,
				'listDate'		=>	$listDate,
		));

	}
	
	/**
	 * @ParamConverter("domaine", options={"mapping": {"nom":"nom"}})
	 * @ParamConverter("evenement", options={"mapping": {"id": "id"}})
	 */
	public function feuilleAction (Sport $domaine, Evenement $evenement,  Request $request)
	{
		
		//on charge les participation de l'évènement 
		$participations = $evenement->getParticipations();
		
		//on trie celles qui ont étés validées par le capitaine :
		$participations = $this->get('bds_participation.manager')->participationValid($participations);
		
		//on retourne la liste des participant 
		return $this->render('BDSEvenementBundle:Evenement:feuille.html.twig', array(
				'domaine'			=>	$domaine,
				'participations'	=>	$participations,
				'evenement'			=>	$evenement
		));
	}

	public function calendrierAction(Sport $domaine)
	{
		
		//on vérifie que l'utilisateur à accès à cette page 
		
		//on récupère touts les évènements (filtre à bosser en fx de l'utilisateur, ce sera le même que dans aside)
		$listEvents = $domaine->getEvenements();
		//trouver un moyen de faire le tri 
		
		//variables utiles 
		$anneeDebut = $listEvents->first()->getDebutEvenement()->format('Y');
		$anneeFin = $listEvents->last()->getFinEvenement()->format('Y');
		
		//on donne les jours de la semaine
		$listJour = $this->get('bds_evenement.manager')->getJourSemaine();
		//on donne les mois de l'année 
		$listMois = $this->get('bds_evenement.manager')->getMois();
		//on fait un tableau contenant toute les dates à afficher 
		$listDate = $this->get('bds_evenement.manager')->getDate($anneeDebut, $anneeFin);
		
		$listAnnee = array();
		for ($i = $anneeDebut; $i <= $anneeFin; $i++)
		{
			$listAnnee[$i] = $i;
		}
		
		//on appelle le template 
		return $this->render('BDSEvenementBundle:Evenement:calendrier.html.twig', array(
				'listEvents'	=>	$listEvents,
				'domaine'		=>	$domaine,
				'listJour'			=>	$listJour,
				'listMois'			=>	$listMois,
				'listDate'			=>	$listDate,
				'listAnnee'		=>	$listAnnee
		));
	}
	
	public function CapitaineEvenementAction (Sport $domaine)
	{
		//on verifie que l'utilisateur courant est bien le capitaine 
		
		//on récupère tous les evenements du domaine
		$listEvents = $domaine->getEvenements();
		
		//on passe à la vue 
		return $this->render('BDSEvenementBundle:Evenement:capitaineEvenement.html.twig', array(
				'domaine'		=>	$domaine,
				'listEvents'	=>	$listEvents
		));
		
	}
}
