<?php

namespace BDS\EvenementBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\EvenementBundle\Entity\Participation;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\EvenementBundle\BDSEvenementBundle;

class ParticipationManager
{
	protected $em;
	
	public function __construct (entityManager $em)
	{
		//on récupère l'entityManager
		$this->em = $em;
	}
	
	public function getRepository()
	{
		//on récupère la bdd
		return $this->em->getRepository('BDSEvenementBundle:Participation');
	}
	
	public function save(Participation $participation)
	{
		$this->em->persist($participation);
		$this->em->flush();
	}
}