<?php

namespace BDS\SportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="bds_role")
 * @ORM\Entity(repositoryClass="BDS\SportBundle\Entity\RoleRepository")
 */
class Role
{
	/**
	 * @ORM\ManyToOne(targetEntity="BDS\SportBundle\Entity\Sport", inversedBy="roles")
	 */
	private $sport;
	
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
     * @return Role
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
     * Set sport
     *
     * @param \BDS\SportBundle\Entity\Sport $sport
     * @return Role
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
}
