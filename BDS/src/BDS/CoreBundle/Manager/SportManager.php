<?php

namespace BDS\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\CoreBundle\Entity\Sport;
use BDS\ImageBundle\Entity\Image;

class SportManager
{
	protected $em;
	
	public function __construct (entityManager $em)
	{
		//on récupère l'entityManaager
		$this->em = $em;
	}
	
	public function getRepository()
	{
		//on récuère la bdd
		return $this->em->getRepository('BDSCoreBundle:Sport');
	}
	
	public function getSport($nom)
	{
		return $this->getRepository()->findOneBy(array('nom' => $nom));
	}
	
	public function save(sport $sport)
	{
		$logo = $sport->getLogo();
		//si le logo est non nul il faut la sauvegarder 
		if($logo != NULL)
		{	
			//on le nomme de manière utomatique
			$logo->setNom('logo_'.$sport->getId(). '_' .$sport->getNom());
			
			//on enregistre l'image
			$logo->uploadImage();
		}
		
		$fond = $sport->getFond();
		//si le fond est non nul il faut le sauvegarder 
		if ($fond != NULL)
		{
			//on le nomme de manière automatique
			$fond->setNom('fond_' .$sport->getId(). '_' . $sport->getNom());
			
			//o enregistre l'image
			$fond->uploadImage();
		}
		
		$this->em->persist($sport);
		$this->em->flush();	
	}
	
	public function delete(sport $sport)
	{
		$logo = $sport->getLogo();
		//si le logo est non nul, il faut le supprimer 
		if($logo != NULL)
		{
			//on supprime l'image 
			$logo->removeImage();
		}
		
		$this->em->remove($sport);
		$this->em->flush();
	}
	
	public function getSports()
	{
		return $this->getRepository()->findAll();
	}
}