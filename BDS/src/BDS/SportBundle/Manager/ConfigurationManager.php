<?php
namespace BDS\SportBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\SportBundle\Entity\Configuration;

class ConfigurationManager
{
	protected $em;
	
	public function __construct (EntityManager $em)
	{
		$this->em = $em;
	}
	
	public function getRepository()
	{
		return $this->em->getRepository('BDSSportBundle:Configuration');
	}
	
	public function save (Configuration $configuration)
	{
		$this->em->persist($configuration);
		$this->em->flush();
	}
}