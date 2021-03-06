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
	 * @var \DateTime
	 * @ORM\Column(name="inscripsion", type="datetime")
	 */
	private $inscripsion;
	
	/**
	 * @ORM\OneToMany(targetEntity="BDS\EvenementBundle\Entity\Participation", mappedBy="membre")
	 */
	private $participations;
	
	/**
	 * @ORM\ManyToOne(targetEntity="BDS\SportBundle\Entity\Sport", inversedBy="membres")
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
     * @param \BDS\SportBundle\Entity\Sport $sport
     * @return Membre
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
     * Constructor
     */
    public function __construct()
    {
        $this->participations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inscripsion = new \DateTime();
    }

    /**
     * Add participation
     *
     * @param \BDS\EvenementBundle\Entity\Participation $participation
     *
     * @return Membre
     */
    public function addParticipation(\BDS\EvenementBundle\Entity\Participation $participation)
    {
        $this->participations[] = $participation;

        return $this;
    }

    /**
     * Remove participation
     *
     * @param \BDS\EvenementBundle\Entity\Participation $participation
     */
    public function removeParticipation(\BDS\EvenementBundle\Entity\Participation $participation)
    {
        $this->participations->removeElement($participation);
    }

    /**
     * Get participations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipations()
    {
        return $this->participations;
    }

    /**
     * Set inscripsion
     *
     * @param \DateTime $inscripsion
     *
     * @return Membre
     */
    public function setInscripsion($inscripsion)
    {
        $this->inscripsion = $inscripsion;

        return $this;
    }

    /**
     * Get inscripsion
     *
     * @return \DateTime
     */
    public function getInscripsion()
    {
        return $this->inscripsion;
    }
}
