<?php

namespace BDS\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\IntegerNode;

/**
 * Evenement
 *
 * @ORM\Table(name="bds_evenement")
 * @ORM\Entity(repositoryClass="BDS\EvenementBundle\Entity\EvenementRepository")
 */
class Evenement
{
	/**
	 * @ORM\OneToMany(targetEntity="BDS\EvenementBundle\Entity\Participation", mappedBy="evenement", orphanRemoval=true)
	 */
	private $participations;
	
	/**
	 * @ORM\ManyToMany(targetEntity="BDS\CoreBundle\Entity\Sport", inversedBy="Evenements", cascade={"persist"})
	 * @ORM\JoinColumn(name="sport_id", referencedColumnName="id")
	 */
	private $sports;
	
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
     * @var \DateTime
     *
     * @ORM\Column(name="debut_evenement", type="datetime")
     */
    private $debutEvenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_evenement", type="datetime")
     */
    private $finEvenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut_inscripsion", type="datetime")
     */
    private $debutInscripsion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_inscripsion", type="datetime")
     */
    private $finInscripsion;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255)
     */
    private $info;

    /**
     * @var IntegerNode
     * 
     * @ORM\Column(name="max_inscrit", type="integer")
     */
    private $maxInscrit;

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
     * @return Evenement
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
     * Set debutEvenement
     *
     * @param \DateTime $debutEvenement
     * @return Evenement
     */
    public function setDebutEvenement($debutEvenement)
    {
        $this->debutEvenement = $debutEvenement;

        return $this;
    }

    /**
     * Get debutEvenement
     *
     * @return \DateTime 
     */
    public function getDebutEvenement()
    {
        return $this->debutEvenement;
    }

    /**
     * Set finEvenement
     *
     * @param \DateTime $finEvenement
     * @return Evenement
     */
    public function setFinEvenement($finEvenement)
    {
        $this->finEvenement = $finEvenement;

        return $this;
    }

    /**
     * Get finEvenement
     *
     * @return \DateTime 
     */
    public function getFinEvenement()
    {
        return $this->finEvenement;
    }

    /**
     * Set debutInscripsion
     *
     * @param \DateTime $debutInscripsion
     * @return Evenement
     */
    public function setDebutInscripsion($debutInscripsion)
    {
        $this->debutInscripsion = $debutInscripsion;

        return $this;
    }

    /**
     * Get debutInscripsion
     *
     * @return \DateTime 
     */
    public function getDebutInscripsion()
    {
        return $this->debutInscripsion;
    }

    /**
     * Set finInscripsion
     *
     * @param \DateTime $finInscripsion
     * @return Evenement
     */
    public function setFinInscripsion($finInscripsion)
    {
        $this->finInscripsion = $finInscripsion;

        return $this;
    }

    /**
     * Get finInscripsion
     *
     * @return \DateTime 
     */
    public function getFinInscripsion()
    {
        return $this->finInscripsion;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Evenement
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sports = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set maxInscrit
     *
     * @param integer $maxInscrit
     * @return Evenement
     */
    public function setMaxInscrit($maxInscrit)
    {
        $this->maxInscrit = $maxInscrit;

        return $this;
    }

    /**
     * Get maxInscrit
     *
     * @return integer 
     */
    public function getMaxInscrit()
    {
        return $this->maxInscrit;
    }

    /**
     * Add sports
     *
     * @param \BDS\CoreBundle\Entity\Sport $sports
     * @return Evenement
     */
    public function addSport(\BDS\CoreBundle\Entity\Sport $sports)
    {
        $this->sports[] = $sports;

        return $this;
    }

    /**
     * Remove sports
     *
     * @param \BDS\CoreBundle\Entity\Sport $sports
     */
    public function removeSport(\BDS\CoreBundle\Entity\Sport $sports)
    {
        $this->sports->removeElement($sports);
    }

    /**
     * Get sports
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSports()
    {
        return $this->sports;
    }

    /**
     * Add participations
     *
     * @param \BDS\EvenementBundle\Entity\Participation $participations
     * @return Evenement
     */
    public function addParticipation(\BDS\EvenementBundle\Entity\Participation $participations)
    {
        $this->participations[] = $participations;

        return $this;
    }

    /**
     * Remove participations
     *
     * @param \BDS\EvenementBundle\Entity\Participation $participations
     */
    public function removeParticipation(\BDS\EvenementBundle\Entity\Participation $participations)
    {
        $this->participations->removeElement($participations);
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
}
