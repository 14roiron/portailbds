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
	
	public function getbyDateIntervallCal( $lundi, $dimanche, Calendrier $cal)
	{
		$queryBuilder = $this->getRepository()->createQueryBuilder('cal');
		$queryBuilder->leftJoin('cal.evenements', 'ev', 'WITH', $queryBuilder->expr()->between('ev.debutEvenement',':min',':max'))
		->setParameters(['nom'=>$cal->getNom(),'min'=>$lundi->format('Y-m-d H:i:s'),'max'=>$dimanche->format('Y-m-d H:i:s')])
		->addSelect('ev')->andWhere('cal.nom = :nom');
		$result = $queryBuilder->getQuery()->getResult();
		
	
	
		//return $result.getEvenements();
		return $result;
	}
		
}