<?php

namespace BDS\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\CoreBundle\Entity\Sport;
use BDS\CoreBundle\Form\SportEditType;
use BDS\CoreBundle\Form\SportType;
use BDS\ImageBundle\Entity\Image;
use BDS\ImageBundle\Form\ImageLieeType;
use BDS\CoreBundle\Form\PresentationType;
use BDS\CoreBundle\Form\motCapitaineType;

class SportController extends Controller
{
	public function addAction(Request $request)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on crée un objet sport 
		$sport = new Sport();
		
		//on crée le formulaire 
		$form = $this->createform( new SportType(), $sport);
		
		//on fait le lien requete<->formulaire
		$form->handleRequest($request);
		
		//on pass par une étape de validation 
		if($form->isValid())
		{	
			//on insert dans la bdd 
			$this->get('bds_sport.manager')->save($sport);
			
			$request->getSession()->getFlashBag()->add('notice', 'Le sport a bien été ajouté.');
			
			//on redirige vers l page de visualisation du sport 
			return $this->redirect($this->generateUrl('bds_sport_view', array(
					'nom' => $sport->getNom()
			)));
		}
		
		//le formuaire n'st pas valide donc on le passe à la vue 
		return $this->render('BDSCoreBundle:Sport:add.html.twig', array(
				'form' => $form->createView(),
				'domaine' => $domaine
		));
		
		
	}
	
	public function deleteAction( Sport $sport)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on supprime le sport 
		$this->get('bds_sport.manager')->delete($sport);
		
		//on rend la page de suppression
		return $this->render('BDSCoreBundle:Sport:delete.html.twig', array(
				'domaine' => $domaine,
				'sport' => $sport
		));
		
	}
	
	public function viewAction( Sport $sport)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on affiche le sport 
		return $this->render('BDSCoreBundle:Sport:view.html.twig', array(
				'sport' => $sport,
				'domaine' => $domaine 
		));
	}
	
	public function editAction(Sport $sport, Request $request)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on crée le formulaire
		$form = $this->createform( new SportEditType(), $sport);
		
		//on fait le lien requete<->formulaire
		$form->handleRequest($request);
		
		//on pass par une étape de validation
		if($form->isValid())
		{	
			//on insert dans la bdd
			$this->get('bds_sport.manager')->save($sport);
				
			$request->getSession()->getFlashBag()->add('notice', 'Le sport a bien été modifié.');
				
			//on redirige vers l page de visualisation du sport
			/*return $this->redirect($this->generateUrl('bds_sport_view', array(
					'nom' => $sport->getNom()
			)));*/
		}
		
		//le formuaire n'st pas valide donc on le passe à la vue
		return $this->render('BDSCoreBundle:Sport:add.html.twig', array(
				'form' => $form->createView(),
				'domaine' => $domaine
		));
		
	}
	
	public function listAction ()
	{
		//on récupère le domaine 
		$domaine = $this->get('bds_sport.manager')->getSport("bds");
		
		//on récupère tout les sport sauf Admin 
		$listSport = $this->get('bds_sport.manager')->getSports();
		
		//on passe à la vue 
		return $this->render('BDSCoreBundle:Sport:list.html.twig', array(
				'domaine'	=>	$domaine,
				'listSport'=>	$listSport
		));
		
	}
	
	/*
	 * @paramConverter('Sport', option=('mapping': {'domaine':'nom'}))
	 */
	public function equipeAction (Sport $domaine)
	{
		//on récupère le domaine 
		//$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		/*erreur si le sport n'existe pas 
		if ($domaine ==NULL)
		{
			throw new NotFoundHttpException("le sport " .$domaine. " n'existe pas");
		}*/
		
		//on récupère les membres du sport 
		$listMembre = $domaine->getMembres();
		
		//on passe à la vue 
		return $this->render('BDSCoreBundle:Sport:equipe.html.twig', array(
				'domaine'		=>	$domaine,
				'listMembre'	=>	$listMembre
		));
	}
	
	/*
	 * @paramConverter('Sport, option=('mapping': {'domaine':'nom'}))
	 */
	public function presentationAction (Sport $domaine)
	{
		//on récupère le sport 
		//$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		/*on lance une exception si le sport n'existe pas 
		if ($domaine == NULL)
		{
			throw new NotFoundHttpException("Le sport n'existe pas." );
		}*/
		
		//on passe à la vue 
		return $this->render('BDSCoreBundle:Sport:presentation.html.twig', array(
				'domaine'	=>	$domaine
		));
	}
	
	/*
	 * @paramConverter('Sport', option=('mapping': {'domaine':'nom'}))
	 */
	public function presentationEditAction (Sport $domaine, Request $request)
	{
	
		//on récupère le sport 
		//$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on creer le formulaire 
		$form = $this->createForm(new PresentationType(), $domaine);
		
		//si le visiteur a soumis le formulaire 
		if ($request->isMethod('POST'))
		{
			//on fait le lien entre le formulaire et la request 
			$form->handleRequest($request);
			
			//on valide les données
			if ($form->isValid())
			{
				//on enregistre dans la bdd
				$this->get('bds_sport.manager')->save($domaine);
				
				//on affiche la nouvelle présentation 
				return $this->redirect($this->generateUrl('bds_sport_presentation', array(
						'domaine'	=> $domaine->getNom(),
				)));
			}
		}
		
		//on passe le formulaire à la vue 
		return $this->render('BDSCoreBundle:Sport:presentationEdit.html.twig', array(
				'domaine' => $domaine,
				'form'	=> $form->createView()
		));
	}
	
	/*
	 * @paramConverter('Sport', option=('mapping': {'domaine':'nom'}))
	 */
	public function motCapitaineAction (Sport $domaine)
	{
		//on récupère le sport 
		//$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on le passe à la vue
		return $this->render('BDSCoreBundle:Sport:motCapitaine.html.twig', array(
				'domaine' => $domaine
		));
	}
	/*
	 * @paramConverter('Sport', option=('mapping': {'domaine':'nom'}))
	 */
	public function motCapitaineEditAction (Sport $domaine, Request $request)
	{
		//on récupère le sport
		//$domaine = $this->get('bds_sport.manager')->getSport($domaine);
		
		//on creer le formulaire
		$form = $this->createForm(new motCapitaineType(), $domaine);
		
		//si le visiteur a soumis le formulaire
		if ($request->isMethod('POST'))
		{
			//on fait le lien entre le formulaire et la request
			$form->handleRequest($request);
				
			//on valide les données
			if ($form->isValid())
			{
				//on enregistre dans la bdd
				$this->get('bds_sport.manager')->save($domaine);
		
				//on affiche la nouvelle présentation
				return $this->redirect($this->generateUrl('bds_sport_motCapitaine', array(
						'domaine'	=> $domaine->getNom(),
				)));
			}
		}
			
			//on passe le formulaire à la vue
			return $this->render('BDSCoreBundle:Sport:motCapitaineEdit.html.twig', array(
					'domaine' => $domaine,
					'form'	=> $form->createView()
			));
		
	}
}