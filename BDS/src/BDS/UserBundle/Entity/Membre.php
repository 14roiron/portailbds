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
     * @ORM\Column(name="role", type="integer", options={"default" = 0})
     */
    /*
    roles:
    role membre = 0b000
    mod_admin = 0b111
    mod_news = 0b010
    mod_evenements = 0b001
    */
    private $role;

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
     * Set role
     *
     * @param integer $role
     *
     * @return Membre
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return integer
     */
    public function getRole()
    {
        return $this->role;
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
