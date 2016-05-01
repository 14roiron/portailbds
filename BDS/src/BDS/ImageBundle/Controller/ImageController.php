<?php

namespace BDS\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\ImageBundle\Entity\Image;
use BDS\ImageBundle\Form\ImageType;

class ImageController extends Controller
{
	public function uploadAction (Request $request)
	{
		//on se place dans Admin 
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		// on crée un objet Image 
		$image = new Image();
		
		//on crée le formulaire 
		$form = $this->createForm( new ImageType(), $image);
		
		//on fait le lien requete <-> formulaire
		$form->handleRequest($request);
		
		//on passe par une étape de validation 
		if($form->isValid())
		{
			//on insert dans la bdd et on upload 
			$this->get('bds_image.manager')->saveImage($image);
			
			$request->getSession()->getFlashBag()->add('notice', 'Image bien enregistrée.');
			
			//on redirige vers la page de visualisation de l'image 
			return $this->redirect($this->generateUrl('bds_image_view', array(
					'nom' => $image->getNom()
			)));
		}
		
		//le formulaire n'est pas valide donc on passe à la vue pour l'afficher 
		return $this->render('BDSImageBundle:Image:upload.html.twig', array(
				'form' 	=> $form->createView(),
				'domaine'	=> $domaine 
		));
	}
	
	public function viewAction(Image $image)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
				
		//on affiche l'image 
		return $this->render('BDSImageBundle:Image:view.Html.twig', array(
				'image' => $image,
				'domaine' => $domaine
		));
	}
	
	public function deleteAction(Image $image)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		

		//on supprime l'image 
		$this->get('bds_image.manager')->removeImage($image);
		

		//on rend la page de suppression
		return $this->render('BDSImageBundle:Image:delete.html.twig', array(
				'domaine' => $domaine,
				'image' => $image
		));
	}
}