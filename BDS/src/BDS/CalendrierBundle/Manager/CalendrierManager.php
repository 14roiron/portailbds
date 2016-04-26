<?php

namespace BDS\CalendrierBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\CalendrierBundle\Entity\Calendrier;

class CalendrierManager
{
	protected $em;

	public function __construct (EntityManager $em)
	{
		$this->em = $em;
	}

	public function getRepository()
	{
		return $this->em->getRepository('BDSCalendrierBundle:Calendrier');
	}
	
	public function get($nom)
	{
		return $this->getRepository()->findOneBy(array('nom'	=>	$nom));
	}
		
}