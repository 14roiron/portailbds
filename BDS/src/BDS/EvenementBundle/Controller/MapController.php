<?php

namespace BDS\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BDS\CoreBundle\Entity\Sport;
use BDS\EvenementBundle\Entity\Lieu;
use BDS\EvenementBundle\Form\LieuType;

class MapController extends Controller
{
	public function FormAction ($domaine)
	{
		//on récupère le domaine 
		$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on fait appel au service form fatory pour fabriquer le formulaire 
		$form = $this->get('form.factory')->create(new LieuType, new Lieu());
		
		//on rend la vue avec le formulaire 
		return $this->render('BDSEvenementBundle:Map:form.html.twig', array(
				'form'	=> $form->createview(),
				'domaine'	=> $domaine
		));
	}
}
