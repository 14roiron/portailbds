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


class NewsController extends Controller
{
	public function indexAction($sport, $page)
	{
		//on récupere le sport
		$sport = $this->get('bds_sport.manager')->getSport($sport);
		$this->denyAccessUnlessGranted('ROLE_SPORT_VIEW', $sport);
		//si la page est inferieur à 1, pas la peine de chercher
		if ($page < 1) 
		{
			throw new NotFoundHttpException('page "'.$page.'" inexistante');
		}
		
		//on recupere la liste des news du sport, on en affiche 10 par page 		
		
		
		//on récupere les news
		$listNews = $sport->getNews();
		
		// si pas de news on affecte un tableau vide pour éviter l'erreur 
		if ($listNews == NULL)
		{ 
			$listNews = []; 
		}
		//on appelle le template 
		return $this->render('BDSNewsBundle:News:index.html.twig', array(
				'listNews' => $listNews,
				'domaine' => $sport
		));
	}
	public function viewAction($sport, $id, Request $request)
	{
		
		//on récupere le sport
		$sportEdit = $this->get('bds_sport.manager')->getSport($sport);
		//si il n'est pas membre du sport concerne on bloque,
		//on récupère la news
		$news = $this->get('bds_news.manager')->getNews($id);

		$this->denyAccessUnlessGranted('ROLE_NEWS_VIEW', $news);

		
		//on lance une exception si la news n'existe pas 
		if ($news == NULL)
		{
			throw new NotFoundHttpException('News "' .$id. '" inexistante');
		}
		
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
					'sport' => $sport,
					'id' => $id
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
	public function addAction($sport, Request $request)
	{
		
		//on récupere le sport
		$sportEdit = $this->get('bds_sport.manager')->getSport($sport);
		$this->denyAccessUnlessGranted('ROLE_SPORT_VIEW', $sport);

		//on récupère le sport
		$sport = $this->get('bds_sport.manager')->getSport($sport);
		
		//On crée un objet news
		$news = new News();
		
		//on crée le formulaire 
		$form = $this->createForm( new NewsType(), $news);

		
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
				'form' =>$form->createView()
		));
	}
	
	public function editAction($sport, $id, Request $request)
	{
		//verifier que le visiteur à le droit d'acceder à cette page 
		
		//on récupere le sport
		$sportEdit = $this->get('bds_sport.manager')->getSport($sport);

	    //on récupère la news
		$news = $this->get('bds_news.manager')->getNews($id);
		//verifie les autorisations d'acces.
		$this->denyAccessUnlessGranted('ROLE_NEWS_EDIT', $sport);
		//on lance une exception si la news n'existe pas 
		if ($news == NULL)
		{
			throw new NotFoundHttpException('News "' .$id. '" inexistante');
		}
		
		//on crée le formulaire
		$form = $this->createForm( new NewsEditType(), $news );
		
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
						'sport' => $sport,
						'id' => $news->GetId()
				)));
			}
		}
		
		//on passe le formulaire à la vue pour qu'elle puisse l'afficher 
		return $this->render('BDSNewsBundle:News:add.html.twig', array(
				'domaine' => $sportEdit,
				'form' =>$form->createView()
		));
		 
		
	}
		public function editCommentaireAction($sport, $id, Request $request)
	{
		//verifier que le visiteur à le droit d'acceder à cette page 
				
		//on récupere le sport
		$sportEdit = $this->get('bds_sport.manager')->getSport($sport);
		//si il n'est pas membre du sport concerne on bloque,
		if($sportEdit->getNom() !="public" && !$this->get('bds_membre.manager')->isMembre($sportEdit->getMembres()))
		{
			throw new NotFoundHttpException('Vous n\'êtes pas membre de ce sport'); //a modifer, pas ouf le 404 pour une erreur comme ca
		}
	    //on récupère la news
		$commentaire = $this->get('bds_Commentaire.manager')->getCommentaire($id);
		
		//on lance une exception si la news n'existe pas 
		if ($commentaire == NULL)
		{
			throw new NotFoundHttpException('Commentaire "' .$id. '" inexistant');
		}
		//on en peut modifier le commentaire que si l\' community ou l'auteur
		if($commentaire->getAuteur()!=$this->getUser() and !$this->get('bds_membre.manager')->isNewsEditor($sportEdit))
		{
			throw new NotFoundHttpException('Vous n\'êtes pas autorisé à faire cela'); //a modifer, pas ouf le 404 pour une erreur comme ca
		}

		
		//on crée le formulaire
		$form = $this->createForm( new CommentaireType(), $commentaire );
		
		//si le visiteur a soumis le formulaire 
		if ($request->isMethod('POST'))
		{
			//on fait le lien entre le formulaire et la requete 
			$form->handleRequest($request);
			
			//on valide les données 
			if ($form->isValid()){
				
				//on enregistre dans la bdd
				$this->get('bds_commentaire.manager')->save($commentaire);
				
				$request->getSession()->getFlashBag()->add('notice', 'Commentaire bien modifiée.');
				//on affiche la page de la nouvelle news
				return $this->redirect($this->generateUrl('bds_news_view', array(
						'sport' => $sport,
						'id' => $commentaire->getNews()->GetId()
				)));
			}
		}
		
		//on passe le formulaire à la vue pour qu'elle puisse l'afficher 
		return $this->render('BDSNewsBundle:News:commentaire.html.twig', array(
				'domaine' => $sportEdit,
				'form' =>$form->createView()
		));
		 
		
	}
	
	public function deleteAction($sport, $id)
	{
				
		//on récupere le sport
		$sport = $this->get('bds_sport.manager')->getSport($sport);
		//si il n'est pas membre du sport concerne on bloque,
		$this->denyAccessUnlessGranted('ROLE_SPORT_VIEW', $sport);


		//on récupere la news
		$news = $this->get('bds_news.manager')->getNews($id);
		$this->denyAccessUnlessGranted('ROLE_NEWS_VALIDATE', $news);
		
		//on supprime l'objet de la base de donnée 
		$this->get('bds_news.manager')->deleteNews($news);
		
		//on rend la page de suppression
		return $this->render('BDSNewsBundle:News:delete.html.twig', array(
				'domaine' => $sport,
				'news' => $news
		));
	}
	public function deleteCommentaireAction($sport, $id)
	{
				
		//on récupere le sport
		$sport = $this->get('bds_sport.manager')->getSport($sport);
		//si il n'est pas membre du sport concerne on bloque,
		if($sport->getNom() !="public" && !$this->get('bds_membre.manager')->isMembre($sport->getMembres()))
		{
			throw new NotFoundHttpException('Vous n\'êtes pas membre de ce sport'); //a modifer, pas ouf le 404 pour une erreur comme ca
		}
				//on récupere la news
		$commentaire = $this->get('bds_commentaire.manager')->getCommentaire($id);
		//on ne peut supprimer que sa news a moins d'etre news manager
		if($commentaire->getAuteur()!=$this->getUser() and !$this->get('bds_membre.manager')->isNewsEditor($sport) )
		{
			throw new NotFoundHttpException('Vous n\'êtes pas autorisé à faire cela'); //a modifer, pas ouf le 404 pour une erreur comme ca
		}
		
		//on supprime l'objet de la base de donnée 
		$this->get('bds_commentaire.manager')->deleteCommentaire($commentaire);
		
		//on rend la page de suppression
		return $this->render('BDSNewsBundle:News:delete.commentaire.html.twig', array(
				'domaine' => $sport,
				'commentaire' => $commentaire
		));
	}
	
	public function validateAction($id, $sport)
	{
				
		//on récupere le sport
		$sportEdit = $this->get('bds_sport.manager')->getSport($sportEdit);
		//on récupere la news
		$news = $this->get('bds_news.manager')->getNews($id);
		$this->denyAccessUnlessGranted('ROLE_NEWS_VALIDATE', $news);
		//on récupère le sport
		$sport = $this->get('bds_sport.manager')->getSport($sport);
		
		//on valide la news 
		$this->get('bds_news.manager')->validateNews($news);
		
		//on rend la page de validation 
		return $this->render('BDSNewsBundle:News:validate.html.twig', array(
				'domaine' => $sportEdit,
				'news' => $news
		));
	}
	
}