<?php

namespace BDS\EvenementBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\EvenementBundle\Entity\Evenement;
use BDS\CoreBundle\Entity\Sport;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EvenementManager
{
	protected $em;
	
	public function __construct (entityManager $em)
	{
		// on récupère l'entityManager
		$this->em = $em;
	}
	
	public function getRepository()
	{
		//on récupère la bdd
		return $this->em->getRepository('BDSEvenementBundle:Evenement');
		
	}
	
	public function getEvenement($id)
	{
		return $this->getRepository()->findOneBy(array('id' => $id));
		
	}
	
	public function save (Evenement $evenement)
	{
		$this->em->persist($evenement);
		$this->em->flush();
	}
	
	public function getAll()
	{
		$list = $this->getRepository()->findAll();
		
		if ($list == NULL)
		{
			return [];
		} else {
			return $list;
		}
	}
	
	public function getEvenements(Sport $sport, $evenements )
	{
		$criteria = Criteria::create();
		$criteria->where(Criteria::expr()->eq('Sports', $sport->getId()));
		
		return $evenements->matching($criteria);

	}
	
}