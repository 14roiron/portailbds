<?php

namespace BDS\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\EvenementBundle\Entity\Evenement;
use BDS\EvenementBundle\Form\EvenementType;

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
	
	public function viewAction ($domaine, $id)
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
		
		//on passe l'evenement à la vue 
		return $this->render('BDSEvenementBundle:Evenement:view.html.twig', array(
				'domaine' 	=>	$domaine,
				'evenement'	=>	$evenement
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
}
