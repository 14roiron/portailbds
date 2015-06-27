<?php

namespace BDS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\CoreBundle\Entity\Sport;
use BDS\UserBundle\Entity\Membre;
use BDS\UserBundle\Form\MembreType;

class SportController extends Controller
{
	public function addAction(Request $request)
	{
		//on crée un objet membre
		$membre = new Membre();
		
		//on crée le formulaire
		$form = $this->createForm(new MembreType(), $membre);
		
		//on fait le lien requet<->formulaire
		$form->handleRequest($request);
		
		//on passe par une étape de validation des donnée
		if($form->isValid())
		{
			// on vérifie qu'il n'y a pas de doublon 
			$this->get('bds_membre.manager')->isMembre($membre->getSport()->getMembres());
			
			//on enregistre l'objet dans la base de donnée
			$this->get('bds_membre.manager')->save($membre);
			
			$request->getSession()->getFlashBag()->add('notice', 'le sport a bien été ajouté.');
			
			//on envoie un mail au capitaine pour qu'il valide
			
			//on affiche la page de l'utilisateur courant 
			return $this->redirect($this->generateUrl('fos_user_profile_show'));
			
		}
		
		//on passe le formulaire à la vue
		return $this->render('BDSUserBundle:Sport:add.html.twig', array(
				'membre' => $membre, 
				'form' => $form->createView()
		));
		
	}
	
	public function deleteAction ($id)
	{
		//on récupère le membre de l'utilisateur courant à supprimer 
		$membre = $this->get('bds_membre.manager')->getMembre($id);
		
		//on supprime l'objet de la bdd
		$this->get('bds_membre.manager')->delete($membre);
		
		//on rend la page de suppression 
		return $this->render('BDSUserBundle:Sport:delete.html.twig', array(
					'membre' => $membre
		));
	}
}