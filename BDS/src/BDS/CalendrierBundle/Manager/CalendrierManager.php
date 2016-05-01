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
 
		$queryBuilder->leftJoin(
    						'cal.evenements',
    						'ev',
    						'WITH',
    						$queryBuilder->expr()->orX(
        									$queryBuilder->expr()->between('ev.debutEvenement', ':lundi', ':dimanche'),
    										$queryBuilder->expr()->between('ev.finEvenement', ':lundi', ':dimanche')
											)
							)
					->setParameters(
    							[
        							'nom'=>$cal->getNom(),
        							'lundi'=>$lundi->format('Y-m-d H:i:s'),
        							'dimanche'=>$dimanche->format('Y-m-d H:i:s')
    							]
						)
					->addSelect('ev')->andWhere('cal.nom = :nom');
 
		$result = $queryBuilder->getQuery()->getResult();
		
		return $result[0]->getEvenements();
	}
		
}