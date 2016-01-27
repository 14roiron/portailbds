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
	
	public function deleteAction($nom)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
				
		//on récupere le sport 
		$sport = $this->get('bds_sport.manager')->getSport($nom);
		
		//on lance une exeption si le sport n'existe pas 
		if($sport == NULL)
		{
			throw new NotFoundHttpException("le sport " .$nom. " n'existe pas.");
		}
		
		//on supprime le sport 
		$this->get('bds_sport.manager')->delete($sport);
		
		//on rend la page de suppression
		return $this->render('BDSCoreBundle:Sport:delete.html.twig', array(
				'domaine' => $domaine,
				'sport' => $sport
		));
		
	}
	
	public function viewAction($nom)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on recupere le sport 
		$sport = $this->get('bds_sport.manager')->getSport($nom);
		
		//on lance une exception si le sport n'existe pas 
		if ($sport == NULL)
		{
			throw new NotFoundHttpException("le sport " .$nom. " n'existe pas.");
		}
		
		//on affiche le sport 
		return $this->render('BDSCoreBundle:Sport:view.html.twig', array(
				'sport' => $sport,
				'domaine' => $domaine 
		));
	}
	
	public function editAction($nom, Request $request)
	{
		//on se place dans Admin
		$domaine = $this->get('bds_sport.manager')->getSport('admin');

		//on récupère le sport 
		$sport = $this->get('bds_sport.manager')->getSport($nom);
		
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
		
		//erreur si le sport n'existe pas
		if ($domaine == NULL)
		{
			throw new NotFoundHttpException("le sport " .$sport. " n'existe pas.");
		}
		
		//on récupère tout les sport sauf Admin 
		$listSport = $this->get('bds_sport.manager')->getSports();
		
		//on passe à la vue 
		return $this->render('BDSCoreBundle:Sport:list.html.twig', array(
				'domaine'	=>	$domaine,
				'listSport'=>	$listSport
		));
		
	}
}