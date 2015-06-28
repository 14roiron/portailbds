<?php

namespace BDS\UserBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\UserBundle\Entity\User;
use BDS\CoreBundle\Entity\Sport;
use Doctrine\Common\Collections\Criteria;
use BDS\UserBundle\Entity\Membre;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MembreManager
{
	protected $em;
	protected $securityContext;
	
	public function __construct (entitymanager $em, $securityContext)
	{
		//on récupère l'entitymanager
		$this->em = $em;
		
		$this->securityContext = $securityContext;
	}
	
	public function getRepository()
	{
		//on récupère la bdd
		return $this->em->getRepository('BDSUserBundle:Membre');
		
	}
	
	public function getUser()
	{
		return $this->securityContext->getToken()->getUser();
	}
	
	public function isMembre ($membres)
	{
		//on récupère l'utilisateur courant 
		$user = $this->getUser();
		
		//on crée le critère 
		$criteria = Criteria::create();
		$criteria->where(Criteria::expr()->eq('user', $user));
		
		//savoir s'il y a un membre
		$membre = $membres->matching($criteria);
		
		if ($membre->count() != 0)
		{ 
			throw new NotFoundHttpException('déjà membre de ce sport');
		} 
	}
	
	public function save( Membre $membre)
	{
		//on ajoute l'utilisateur
		$membre->setUser($this->getUser());
		
		//on sauvegarde dans la BDD
		$this->em->persist($membre);
		$this->em->flush();
		
	}
	
	public function getMembre ($id)
	{
		//on cherche le membre associé à l'id
		return $this->getRepository()->findOneById($id);
		
	}
	
	public function delete ($membre)
	{
		//on le supprime de la bdd
		$this->em->remove($membre);
		$this->em->flush();
		
	}
}

