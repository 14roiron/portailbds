<?php

namespace BDS\NewsBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\NewsBundle\Entity\News;
use BDS\NewsBundle\Entity\Validation;
use BDS\UserBundle\Entity\User;

use Symfony\Component\Security\Core\SecurityContext;

class NewsManager 
{
	protected $em;
	protected $securityContext;
	
	public function __construct(entityManager $em, $securityContext)
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
	
	public function firstSave(news $news)
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
		//mise a jour de la validation
		$this->updateValidations($news);
		
		//la date est ajouté à la construction
		
		//on sauvegarde dans la base de donnée 
		$this->em->persist($news);
		$this->em->flush();
		
	}
	
	public function save( news $news)
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
		$this->updateValidations($news);
		$this->em->persist($news);
		$this->em->flush();
	}
	
	public function deleteNews($news)
	{	
		//on la supprime de la base de donnée 
		$this->em->remove($news);
		$this->em->flush();
		
		
	}

	
	public function validateNews($news,$sport)
	{
		//on valide la news 
		$validate=  $this->em
      	->getRepository()
      	->findBy(array('news' => $news,'sport'=>$sport));
		$validate->setValide(TRUE);
		$validate->setEditeur($this->getUser());
		
		//on MAJ la bdd
		$this->em->flush();
	}
	public function updateValidations($news)
    {
        foreach($news->getValidations() as $validation)
        {
        	$this->em->remove($validation);
        }
        $news->removeAllValidations();
        // a chaque modification de la news, elle doit etre revalide pour chaque sport
        foreach ($news->getSports() as $sport) {

            $validation=new Validation();
            $validation->setSport($sport);
            $validation->setValide(false);
            $validation->setNews($news);
            $this->em->persist($validation);
            $news->addValidation($validation);
        }
        $this->em->flush();
    }
	
	
}