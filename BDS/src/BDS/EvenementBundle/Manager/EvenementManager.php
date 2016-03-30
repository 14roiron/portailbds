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
	
	public function __construct (EntityManager $em)
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
	
	public function deleteEvenement($evenement)
	{
		$this->em->remove($evenement);
		$this->em->flush();
	}
	
	public function getSortByDate($init, $limite)
	{
		
		$query = $this->getRepository()->createQueryBuilder('e')
			->orderBy('e.debutEvenement', 'ASC')
			->getQuery();
		
		$listEvents = $query->getResult();
		
		return $listEvents;
	}
	
	public function getDate($anneeDebut, $anneeFin)
	{
		$r = array();
		
		$date = new \DateTime($anneeDebut.'-01-01');
		
		while($date->format('Y') <= $anneeFin)
		{
			//on veut $r[annee][mois][jour] = jour de la semaine
			$a = $date->format('Y');
			$m = $date->format('n');
			$j = $date->format('j');
			$js = str_replace('0', '7', $date->format('w'));
			$r[$a][$m][$j] = $js;
			$date->add(new \DateInterval('P1D'));
		}
		
		return $r;
	}
}
