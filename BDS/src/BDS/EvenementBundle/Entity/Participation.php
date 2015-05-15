<?php

namespace BDS\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="bds_participation")
 * @ORM\Entity(repositoryClass="BDS\EvenementBundle\Entity\ParticipationRepository")
 */
class Participation
{
	
	/**
	 * @ORM\ManyToOne(targetEntity="BDS\EvenementBundle\Entity\Evenement", inversedBy="participations", cascade={"persist"})
	 * 
	 */
	private $evenement;
	
	/**
	 * @ORM\ManyToOne(targetEntity="BDS\UserBundle\Entity\User", inversedBy="participations", cascade={"persist"})
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
     * @var boolean
     *
     * @ORM\Column(name="participation", type="boolean")
     */
    private $participation;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validationCapitaine", type="boolean")
     */
    private $validationCapitaine;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validationUser", type="boolean")
     */
    private $validationUser;


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
     * Set participation
     *
     * @param boolean $participation
     * @return Participation
     */
    public function setParticipation($participation)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get participation
     *
     * @return boolean 
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Participation
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set validationCapitaine
     *
     * @param boolean $validationCapitaine
     * @return Participation
     */
    public function setValidationCapitaine($validationCapitaine)
    {
        $this->validationCapitaine = $validationCapitaine;

        return $this;
    }

    /**
     * Get validationCapitaine
     *
     * @return boolean 
     */
    public function getValidationCapitaine()
    {
        return $this->validationCapitaine;
    }

    /**
     * Set validationUser
     *
     * @param boolean $validationUser
     * @return Participation
     */
    public function setValidationUser($validationUser)
    {
        $this->validationUser = $validationUser;

        return $this;
    }

    /**
     * Get validationUser
     *
     * @return boolean 
     */
    public function getValidationUser()
    {
        return $this->validationUser;
    }

    /**
     * Set evenement
     *
     * @param \BDS\EvenementBundle\Entity\Evenement $evenement
     * @return Participation
     */
    public function setEvenement(\BDS\EvenementBundle\Entity\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \BDS\EvenementBundle\Entity\Evenement 
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set user
     *
     * @param \BDS\UserBundle\Entity\User $user
     * @return Participation
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
}
