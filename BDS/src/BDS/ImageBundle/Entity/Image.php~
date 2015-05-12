<?php

namespace BDS\ImageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table(name="bds_image")
 * @ORM\Entity(repositoryClass="BDS\ImageBundle\Entity\ImageRepository")
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="nom", type="text")
     */
    private $nom;
    
    /**
     * @Assert\File(maxSize="500k")
     */
    public $file;
    

    public function getWebPath()
    {
    	return null === $this->nom ? null : $this->getUploadDir().'/'.$this->nom;
    }
    
    protected function getUploadRootDir()
    {
    	// le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
    	return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    	// get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
    	return 'images';
    }
    
    public function uploadImage()
    {
    	// Nous utilisons le nom de fichier original, donc il est dans la pratique
    	// nécessaire de le nettoyer pour éviter les problèmes de sécurité
    
    	// move copie le fichier présent chez le client dans le répertoire indiqué.
    		$this->file->move($this->getUploadRootDir(), $this->nom);
  
    	// La propriété file ne servira plus
    	$this->file = null;
    }
    
    public function removeImage()
    {
    	//on retire le fichier
    	unlink($this->getUploadRootDir().'/'.$this->nom);
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Image
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
}
