<?php

namespace BDS\SponsorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\SponsorBundle\Entity\Sponsor;
use BDS\SponsorBundle\Form\SponsorType;

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
			$this ->get('bds_sponsort.manager')->save($sponsor);
			
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
	
	public function viewAction($id)
	{
		
	}
	
	public function deleteAction($id)
	{
		
	}
}