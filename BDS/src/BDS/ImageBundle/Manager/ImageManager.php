<?php

namespace BDS\ImageBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\ImageBundle\Entity\Image;

class ImageManager
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
		return $this->em->getRepository('BDSImageBundle:Image');
	}
	
	public function saveImage( Image $image)
	{
		//on réalise l'upload
		$image->uploadImage();
		
		//on enregistre l'image dans la base de donnée 
		$this->em->persist($image);
		$this->em->flush();
	}
	
	public function removeImage (Image $image)
	{
		//on supprime l'image 
		$image->removeImage();
		
		//on enleve l'image de la bdd
		$this->em->remove($image);
		$this->em->flush();
	}
	
	public function findImage($nom)
	{
		return $this->getRepository()->findOneBy(array('nom' => $nom));
	}
}