<?php

namespace BDS\SportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\SportBundle\Entity\Configuration;
use BDS\SportBundle\Form\ConfigurationType;

class ConfigurationController extends Controller
{
	public function addAction ( Request $request)
	{
		//on cree un objet configuration 
		$configuration = new Configuration();
		
		//on creer le formulaire 
		$form = $this->createform( new ConfigurationType(), $configuration );
		
		//on fait le lien requete<->formulaire 
		$form->handleRequest($request);
		
		//on passe par une étape de validation 
		if($form->isValid())
		{
			//on l'insert dans la bdd
			$this->get('bds_configuration.manager')->save($configuration);
			
			$request->getSession()->getFlashBag()->add('success', 'La configuration a bien été ajouté à '.$configuration->getSport().'.');
			
			//on redirige vers la page de visualisation 
			return $this->redirect($this->generateUrl('bds_admin_configuration_view', array(
					'nom'	=>	$configuration->getNom()
			)));
		}
		
		//le formulaire n'est pas valide donc on passe à la vue 
		return $this->render('BDSSportBundle:Configuration:add.html.twig', array(
				'form'	=>	$form->createView(),
		));
	}
}