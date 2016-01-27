<?php

namespace BDS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membre
 *
 * @ORM\Table(name="bds_membre")
 * @ORM\Entity(repositoryClass="BDS\UserBundle\Entity\MembreRepository")
 */
class Membre
{
	/**
	 * @ORM\ManyToOne(targetEntity="BDS\CoreBundle\Entity\Sport", inversedBy="membres")
	 */
	private $sport;
	
	/**
	 * @ORM\ManyToOne(targetEntity="BDS\UserBundle\Entity\User", inversedBy="membres")
	 */
	private $user;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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
     * Set user
     *
     * @param \BDS\UserBundle\Entity\User $user
     * @return Membre
     */
    public function setUser(\BDS\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BDS\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set sport
     *
     * @param \BDS\CoreBundle\Entity\Sport $sport
     * @return Membre
     */
    public function setSport(\BDS\CoreBundle\Entity\Sport $sport = null)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return \BDS\CoreBundle\Entity\Sport 
     */
    public function getSport()
    {
        return $this->sport;
    }
}
