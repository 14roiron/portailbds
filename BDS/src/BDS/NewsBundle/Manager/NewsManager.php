<?php

namespace BDS\NewsBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\NewsBundle\Entity\News;
use BDS\UserBundle\Entity\User;
use Symfony\Component\Security\Core\SecurityContext;

class NewsManager
{
	protected $em;
	protected $securityContext;
	
	public function __construct(EntityManager $em, $securityContext)
	{
		//on recupere l'entityManager dont on va se servir 
		$this->em = $em;
		//on recupère le security context pour récuperer le user 
		$this->securityContext = $securityContext;
	}

	public function getRepository()
	{
		//on récupère la base de donnée avec les News
		return $this->em->getRepository('BDSNewsBundle:News');
	}
	
	public function getUser()
	{
		//on récupère le User pour donner l'auteur 
		return $this->securityContext->getToken()->getUser();
	}
	
	public function getNews($id)
	{
		//on retourne la News qui correspond à l'Id
		return $this->getRepository()->findOneById($id);
	}
	
	public function firstSave(News $news)
	{
		/*
		 * la news arrive d'un commentaire elle contient donc déjà 
		 * un contenu,
		 * des sports,
		 * un titre,
		 * un résumé,
		 * 
		 */
		
		//on ajoute l'auteur 
		$auteur = $this->getUser();
		$news->setAuteur($auteur);
		
		//la date est ajouté à la construction
		
		//on sauvegarde dans la base de donnée 
		$this->em->persist($news);
		$this->em->flush();
		
	}
	
	public function save( News $news)
	{
		/*
		 * la news arrive d'un commentaire elle contient donc déjà
		 * un contenu,
		 * des sports,
		 * un titre,
		 * un résumé,
		 * un auteur,
		 * une date de publication 
		 */
		
		//on ajoute l'éditeur 
		$editeur = $this->getUser();
		$news->setEditeur($editeur);
		
		//la date de modification est un compris dans le cycle de vie 
		
		//on sauvegarde la news dans la bdd
		$this->em->persist($news);
		$this->em->flush();
	}
	
	public function deleteNews($news)
	{	
		//on la supprime de la base de donnée 
		$this->em->remove($news);
		$this->em->flush();
		
		
	}
	
	public function validateNews($news)
	{
		//on valide la news 
		$news->setValidation(TRUE);
		
		//on MAJ la bdd
		$this->em->flush();
	}
}