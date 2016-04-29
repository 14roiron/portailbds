<?php

namespace BDS\SportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuration
 *
 * @ORM\Table(name="bds_configuration")
 * @ORM\Entity(repositoryClass="BDS\SportBundle\Entity\ConfigurationRepository")
 */
class Configuration
{
	/**
	 * @ORM\ManyToOne(targetEntity="BDS\SportBundle\Entity\Sport", inversedBy="configurations")
	 */
	private $sport;
	
	/**
	 * @ORM\OneToOne(targetEntity="BDS\ImageBundle\Entity\Image", cascade={"persist"}, orphanRemoval=true)
	 */
	private $image;
	
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;


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
     *
     * @return Configuration
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

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Configuration
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set sport
     *
     * @param \BDS\SportBundle\Entity\Sport $sport
     *
     * @return Configuration
     */
    public function setSport(\BDS\SportBundle\Entity\Sport $sport = null)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return \BDS\SportBundle\Entity\Sport
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set image
     *
     * @param \BDS\ImageBundle\Entity\Image $image
     *
     * @return Configuration
     */
    public function setImage(\BDS\ImageBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \BDS\ImageBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
