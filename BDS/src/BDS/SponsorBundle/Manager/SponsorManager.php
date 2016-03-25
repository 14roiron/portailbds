<?php

namespace BDS\SponsorBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\SponsorBundle\Entity\Sponsor;

class SponsorManager
{
	protected $em;
	
	public function __construct(entityManager $em)
	{
		//on récupère l'entityManager
		$this->em = $em;
	}
	
	public function getRepository()
	{
		//on récupère la bdd
		return $this->em->getRepository('BDSCoreBundle:Sponsor');
	}
	
	public function save(Sponsor $sponsor)
	{
		$this->em->persist($sponsor);
		$this->em->flush();
	}
}
