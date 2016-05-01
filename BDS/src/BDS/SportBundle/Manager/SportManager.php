<?php

namespace BDS\SportBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\SportBundle\Entity\Sport;
use BDS\ImageBundle\Entity\Image;

class SportManager
{
	protected $em;
	
	public function __construct (EntityManager $em)
	{
		//on récupère l'entityManaager
		$this->em = $em;
	}
	
	public function getRepository()
	{
		//on récuère la bdd
		return $this->em->getRepository('BDSSportBundle:Sport');
	}
	
	public function getSport($nom)
	{
		return $this->getRepository()->findOneBy(array('nom' => $nom));
	}
	
	public function save(Sport $sport)
	{
		//à la crétion il faut donner au calendrier le nom du sport 
		if($sport->getCalendrier()->getNom() == null)
		{
			$sport->getCalendrier()->setNom($sport->getNom());
		}
		
		$logo = $sport->getLogo();
		//si le logo est non nul il faut la sauvegarder 
		if($logo != NULL && $logo->getFile() !=NULL)
		{	
			//on le nomme de manière automatique
			$logo->setNom('logo_'.$sport->getId(). '_' .$sport->getNom());
			
			//on enregistre l'image
			$logo->uploadImage();
		}
		
		$fond = $sport->getFond();
		//si le fond est non nul il faut le sauvegarder 
		if ($fond != NULL && $fond->getFile() != NULL)
		{
			//on le nomme de manière automatique
			$fond->setNom('fond_' .$sport->getId(). '_' . $sport->getNom());
			
			//o enregistre l'image
			$fond->uploadImage();
		}
		
		$this->em->persist($sport);
		$this->em->flush();	
	}
	
	public function delete(Sport $sport)
	{
		$logo = $sport->getLogo();
		$fond = $sport->getFond();
		
		//si le logo et le fond sont non nuls, il faut les supprimer 
		if($logo != NULL)
		{
			$logo->removeImage();
		}
		if($fond != NULL)
		{
			$fond->removeImage();
		}
		
		$this->em->remove($sport);
		$this->em->flush();
	}
	
	public function getSports()
	{
		return $this->getRepository()->findAll();
	}
	
	public function getEvenementSince(Sport $sport, \DateTime $date)
	{
		//on récupère tous les evenements 
		$cal = $sport->getCalendrier();
		$evenements = $cal->getEvenements();
		
		//on trie 
		foreach($evenements as $key => $evenement)
		{
			if($evenement->getDebutEvenement() < $date)
			{
				//on détruit la variable
				unset($evenements[$key]);
			}
		}
		
		//on refait un tableau bien incrémenté : 
		//$evenements = array_values($evenements);
		
		return $evenements;
		
	}
}