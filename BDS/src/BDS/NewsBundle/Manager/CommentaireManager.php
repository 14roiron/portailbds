<?php

namespace BDS\NewsBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\NewsBundle\Entity\Commentaire;
use BDS\NewsBundle\Entity\News;
use BDS\UserBundle\Entity\User;
use Symfony\Component\Security\Core\SecurityContext;

class CommentaireManager
{
	protected $em;
	protected $securtyContext;
	
	public function __construct(EntityManager $em, $securityContext)
	{
		//on recupere l'entitymanager
		$this->em = $em;
		//on recupere le security contexte
		$this->securityContext = $securityContext;
		
	}
	
	public function getRepository()
	{
		//on recupere la base de donnée avec les commentaires
		return $this->em->getRepository('BDSNewsBundle:Commentaire');
	}
	
	public function getUser()
	{
		//on recupere le user pour donner l'auteur 
		return $this->securityContext->getToken()->getUser();
		
	}
	public function getCommentaire($id)
	{
		//on retourne la News qui correspond à l'Id
		return $this->getRepository()->findOneById($id);
	}
		public function save( commentaire $commentaire)
	{
		//on sauvegarde le commentaire dans la bdd
		$this->em->persist($commentaire);
		$this->em->flush();
	}
	
	public function saveCommentaire(Commentaire $commentaire, News $news)
	{
		//le commentaire arrive d'un formulaire donc il a déjà un contenu
		//on ajoute l'auteur
		$auteur = $this->getUser();
		$commentaire->setAuteur($auteur);
		
		//on lie la news et le commentaire 
		$news->addCommentaire($commentaire);
		
		//on enregistre l'objet dans la base de donnée 
		$this->em->persist($news);
		$this->em->flush();
	}
	public function deleteCommentaire($commentaire)
	{	
		//on la supprime de la base de donnée 
		$this->em->remove($commentaire);
		$this->em->flush();
		
		
	}
}