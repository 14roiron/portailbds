<?php

namespace BDS\SponsorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\SponsorBundle\Entity\Sponsor;
use BDS\SponsorBundle\Form\SponsorType;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SponsorController extends Controller
{
	public function addAction(Request $request)
	{
		//on se place dans Admin 
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on crée un objet sponsor
		$sponsor = new Sponsor();
		
		//on crée le formulaire
		$form = $this->createForm(new SponsorType(), $sponsor);
		
		//on fait le lien requete<->formulaire 
		$form->handleRequest($request);
		
		//on passe par une étape de validation 
		if ($form->isValid())
		{
			//on insert dans la bdd
			$this ->get('bds_sponsor.manager')->save($sponsor);
			
			//on redirige vers la page de visualisation 
			return $this->redirect($this->generateUrl('bds_sponsor_view', array(
					'nom'	=>	$sponsor->getNom()
			)));
		}
		
		//le formulaire n'est pas valide donc on le passe à la vue 
		return $this->render('BDSSponsorBundle:Sponsor:add.html.twig', array(
				'form'		=> 	$form->createView(),
				'domaine'	=>	$domaine
		));
		
	}
	
	public function viewAction($nom)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on récupère l'objet sponsor
		$sponsor = $this->get('bds_sponsor.manager')->getSponsor($nom);
		
		//on affiche la page 
		return $this->render('BDSSponsorBundle:Sponsor:view.html.twig', array(
				'sponsor'	=>	$sponsor,
				'domaine'	=>	$domaine
		));
		
	}
	
	public function deleteAction($nom)
	{
		//on se place dans admin 
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on récupère l'objet sponsort 
		$sponsort = $this->get('bds_sponsor.manager')->getsponsor($nom);
		
		//on revoit une erreur si le sponsort n'existe pas 
		if ($sponsort == NULL)
		{
			throw new NotFoundHttpException("le sponsort " .$nom. " n'existe pas.");
		}
		
		//on le supprime 
		$this->get('bds_sponsor.manager')->delete($sponsort);
		
		//il faudrait renvoyer un petit message avec :-)
		
		//on retourne à la liste 
		return $this->render('BDSSponsorBundle:Sponsor:list.html.twig', array(
				'domaine'	=>	$domaine
		));
		
	}
	
	public function listAction()
	{
		//on se place dans admin 
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on fait la liste des sponsors
		$listSponsors = $this->get('bds_sponsor.manager')->getSponsors();
		
		//on les affiches tous 
		return $this->render('BDSSponsorBundle:Sponsor:list.html.twig', array(
			'domaine'		=>	$domaine,
			'listSponsors'	=>	$listSponsors
		));
	}
}