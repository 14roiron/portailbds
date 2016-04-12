<?php

namespace BDS\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\NewsBundle\Entity\News;
use BDS\NewsBundle\Form\NewsEditType;
use BDS\NewsBundle\Form\NewsType;
use BDS\NewsBundle\Entity\Commentaire;
use BDS\NewsBundle\Form\CommentaireType;
use BDS\NewsBundle\Manager\NewsManager;
use BDS\CoreBundle\Entity\Sport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class NewsController extends Controller
{
	
	public function indexAction( Sport $sportEdit, $page)
	{
		//si la page est inferieur à 1, pas la peine de chercher
		if ($page < 1) 
		{
			throw new NotFoundHttpException('page "'.$page.'" inexistante');
		}
		
		//on recupere la liste des news du sport, on en affiche 10 par page 		
		
		//on récupere les news
		$listNews = $sportEdit->getNews();
		
		// si pas de news on affecte un tableau vide pour éviter l'erreur 
		if ($listNews == NULL)
		{ 
			$listNews = []; 
		}
		//on appelle le template 
		return $this->render('BDSNewsBundle:News:index.html.twig', array(
				'listNews' => $listNews,
				'domaine' => $sportEdit
		));
	}
	
	/**
	 * @ParamConverter("sportEdit", options={"mapping": {"nom": "nom"}})
	 */
	public function viewAction(Sport $sportEdit, News $news, Request $request)
	{

		//on crée un objet commentaire
		$commentaire = new Commentaire();
		
		//on crée le formulaire 
		$form = $this->createform(new CommentaireType(), $commentaire);
		
		//on fait le lien requete formulaire
		$form->handleRequest($request);
		
		//on passe par une étape de validation des données
		if($form->isValid())
		{
			$this->get('bds_commentaire.manager')->saveCommentaire($commentaire, $news);
			
			$request->getSession()->getFlashBag()->add('notice', 'Commentaire bien enregistré.');
			
			//on affiche la page de la nouvelle news
			return $this->redirect($this->generateUrl('bds_news_view', array(
					'sport' => $sportEdit->getNom(),
					'id' => $news->getId()
			)));
			
			
		}
		
		//on récupère les commentaire de $news
		$listCommentaire = $news->getCommentaires();
			
		//on affecte un tableau vide si rien 
		if($listCommentaire == NULL)
		{
			$listCommentaire = [];
		}
		
		//on passe la news à la vue pour l'affichage
		return $this->render('BDSNewsBundle:News:view.html.twig', array( 
				'news' => $news,
				'domaine' => $sportEdit,
				'listCommentaire' => $listCommentaire,
				'form' => $form->createView()
		));
		
	}
	
	public function addAction(Sport $sport, Request $request)
	{
		//verifier que le visiteur a le droit d'acceder à cette page
		
		//On crée un objet news
		$news = new News();
		
		//on crée le formulaire 
		$form = $this->createForm( new NewsType(), $news );
		
		//on fait le lien requete <-> formulaire
		$form->handleRequest($request);
		
		//on passe par une étape de validation des données 
		if($form->isValid())
		{
			//on enregistre l'objet dans la base de donnée
			$this->get('bds_news.manager')->firstSave($news);

			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
				
			//on envoie un mail au VP comunication pour qu'il valide la news

			//on affiche la page de la nouvelle news
			return $this->redirect($this->generateUrl('bds_news_view', array(
					'sport' => $sport->getNom(),
					'id' => $news->GetId()
			)));
			
		}
		/*le formulaire n'est pas valide soit :
		 * c'est la premiere visite de l'utilisateur donc il n'a pas envoyer de formulaire
		 * soit le formulaire n'est pas valide
		 */
		
		//on passe le formulaire à la vue pour qu'elle puisse l'afficher 
		return $this->render('BDSNewsBundle:News:add.html.twig', array(
				'domaine' => $sport,
				'form' =>$form->createView(),
				'affichage' => 'ajouter'
		));
	}
	
	/**
	 * @paramConverter("sport", options={"mapping": {"nom": "nom"}})
	 */
	public function editAction(Sport $sport, News $news, Request $request)
	{
		//verifier que le visiteur à le droit d'acceder à cette page 
		
		//on crée le formulaire
		$form = $this->createForm( new NewsType(), $news );
		
		//si le visiteur a soumis le formulaire 
		if ($request->isMethod('POST'))
		{
			//on fait le lien entre le formulaire et la requete 
			$form->handleRequest($request);
			
			//on valide les données 
			if ($form->isValid()){
				
				//on enregistre dans la bdd
				$this->get('bds_news.manager')->save($news);
				
				$request->getSession()->getFlashBag()->add('notice', 'News bien modifiée.');
				
				//on affiche la page de la nouvelle news
				return $this->redirect($this->generateUrl('bds_news_view', array(
						'domaine' => $sport,
						'id' => $news->GetId()
				)));
			}
		}
		
		//on passe le formulaire à la vue pour qu'elle puisse l'afficher 
		return $this->render('BDSNewsBundle:News:add.html.twig', array(
				'domaine' => $sport,
				'form' =>$form->createView(),
				'affichage'	=> 'editer'
		));
		 
		
	}
	
	/**
	 * @ParamConverter("sport", options={"mapping": {"nom": "nom"}})
	 */
	public function deleteAction(Sport $sport, News $news)
	{
		
		//on supprime l'objet de la base de donnée 
		$this->get('bds_news.manager')->deleteNews($news);
		
		//on rend la page de suppression
		return $this->render('BDSNewsBundle:News:delete.html.twig', array(
				'domaine' => $sport,
				'news' => $news
		));
	}
	
	/**
	 * @ParamConverter("sport", options={"mapping": {"nom": "nom"}})
	 */
	public function validateAction(News $news, Sport $sport)
	{
		
		//on valide la news 
		$this->get('bds_news.manager')->validateNews($news);
		
		//on rend la page de validation 
		return $this->render('BDSNewsBundle:News:validate.html.twig', array(
				'domaine' => $sport,
				'news' => $news
		));
	}
}