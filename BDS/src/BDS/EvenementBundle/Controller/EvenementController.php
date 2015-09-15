<?php

namespace BDS\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\EvenementBundle\Entity\Evenement;
use BDS\EvenementBundle\Form\EvenementType;
use BDS\CoreBundle\Entity\Sport;
use BDS\EvenementBundle\Entity\Participation;
use BDS\EvenementBundle\Form\MAJEvenementType;

class EvenementController extends Controller
{
	public function indexAction ($domaine, $page)
	{
		//si la page est inferieur à 1, pas la peine de l'afficher
		if ($page < 1)
		{
			throw new NotFoundHttpException('page "'.$page.'" inexistante');
		}
		
		//on se place dans le bon domaine 
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
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
	
	public function viewAction ($domaine, $id, Request $request)
	{
		//on se place dans le bon domaine 
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on vérifie que l'utilisateur à accès à cette page
		
		//on recupere l'evenement 
		$evenement = $this->get('bds_evenement.manager')->getEvenement($id);
		
		//on lance une exception si l'event n'eiste pas 
		if ($evenement == NULL)
		{
			throw new NotFoundHttpException('Evenement "' .$id. '" inexistant');
		}
		
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
					'domaine'	=>	$domaine->getNom(),
					'id'		=> $id
			)));
		}
		//on passe l'evenement à la vue 
		return $this->render('BDSEvenementBundle:Evenement:view.html.twig', array(
				'domaine' 	=>	$domaine,
				'evenement'	=>	$evenement,
				'form'		=>	$form->createView()
		));
	}
	
	public function addAction ($domaine, Request $request)
	{
		//verifier que le visiteur a le droit d'acceder à cette page
		
		//on récupère le domaine 
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on crée un objet Evenement 
		$evenement = new Evenement();
		
		//on crée le formulaire 
		$form = $this->createForm(new EvenementType(), $evenement);

		//on fait le lien requete formulaire 
		$form->handleRequest($request);
		
		/*
		 * si les champs complémentaires n'ont pas été rempli on
		 * charge une date de fin et de début des inscripsion pour éviter mes inscripsion sauvage
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
					$evenement->addParticipation($participation);
					
					//on sauvegarde la participation
					$this->get('bds_participation.manager')->save($participation);
				}
				
				//on enregistre l'objet dans la bdd
				$this->get('bds_evenement.manager')->save($evenement);
			}
			
			$request->getSession()->getFlashBag()->add('notice', 'Evenement bien enregistré.');
			
			//on affiche la page du nouvel évenement
			return $this->redirect($this->generateUrl('bds_evenement_view', array(
					'domaine'	=>	$domaine->getNom(),
					'id'		=> $evenement->getId()
			)));
		}
			
			//on passe le formulaire à la vue
			return $this->render('BDSEvenementBundle:Evenement:add.html.twig', array(
					'domaine'	=>	$domaine,
					'form'		=>$form->createView()
			));
			
	}
	
	public function editAction ($domaine,$id, Request $request)
	{
		//verifier que le visiteur a le droit d'acceder à cette page
		
		//on récupère le domaine 
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on crée un objet Evenement 
		$evenement= $this->get('bds_evenement.manager')->getEvenement($id);;
		
		//on lance une exception si l'évènement n'existe pas 
		if ($evenement == NULL)
		{
			throw new NotFoundHttpException('Evènement "' .$id. '" inexistant');
		}
		//on crée le formulaire 
		$form = $this->createForm(new EvenementType(), $evenement);

		//on fait le lien requete formulaire 
		$form->handleRequest($request);
		
		//on passe par une étape de validation 
		if($form->isValid())
		{
			//on enregistre l'objet dans la bdd
			$this->get('bds_evenement.manager')->save($evenement);
			
			$request->getSession()->getFlashBag()->add('notice', 'Evenement bien enregistré.');
			
			//on affiche la page du nouvel évenement
			return $this->redirect($this->generateUrl('bds_evenement_view', array(
					'domaine'	=>	$domaine->getNom(),
					'id'		=> $evenement->getId()
			)));
		}
			
			//on passe le formulaire à la vue
			return $this->render('BDSEvenementBundle:Evenement:add.html.twig', array(
					'domaine'	=>	$domaine,
					'form'		=>$form->createView()
			));
		
	}
	
	public function deleteAction ($domaine, $id)
	{
		//on se place dans le bon domaine
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on récupere l'évènement
		$evenement = $this->get('bds_evenement.manager')->getEvenement($id);
		
		//on supprime l'objet de la base de donnée 
		$this->get('bds_evenement.manager')->deleteEvenement($evenement);
		
		//on rend la page de suppression
		return $this->render('BDSEvenementBundle:Evenement:delete.html.twig', array(
				'domaine' => $domaine,
				'evenement' => $evenement
		));
	}
	
	public function calendarAction ($domaine)
	{
		//on se place dans le bon domaine
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on affiche le calendrier (on s'interessera plus tard au visiteur
		return $this->render('BDSEvenementBundle:Evenement:calendrier.html.twig', array(
				'domaine'	=> $domaine
		));
	}
	
	public function asideAction ( $domaine)
	{
		//on se place dans le bon domaine 
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on affiche les evenements filtrés
		$evenements = $domaine->getEvenements();
		
		//on affiche les évenements dans le bloc aside 
		return $this->render('BDSEvenementBundle:Evenement:aside.html.twig', array(
				'evenements'	=>	$evenements,
				'domaine'		=>	$domaine	
		));	

	}
	
	public function feuilleAction ($domaine, $id,  Request $request)
	{
		
		//on se place dans le bon domaine 
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on récupère l'évènement 
		$evenement = $this->get('bds_evenement.manager')->getEvenement($id);
		
		//on charge les participation de l'évènement 
		$participations = $evenement->getParticipations();
		
		//on trie celles qui ont étés validées par le capitaine :
		$particpations = $this->get('bds_participation.manager')->participationValid($participation);
		
		//on retourne la liste des participant 
		return $this->render('BDSEvenementBundle:Evenement:feuille.html.twig', array(
				'domaine'			=>	$domaine,
				'$articipations'	=>	$participations
		));
		
		
		
	}
}
