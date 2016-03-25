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
		$logo = $sponsor->getLogo();
		//si le logo est non nul il faut le sauvegarder 
		if($logo != NULL && $logo->getFile() != NULL)
		{
			//on le nomme de manière automatique
			$logo->setNom('sponsor_' .$sponsor->getId(). '_' .$sponsor->getNom());
			
			//on enregistre l'image 
			$logo->uploadImage();
			
		}
		
		$this->em->persist($sponsor);
		$this->em->flush();
	}
}