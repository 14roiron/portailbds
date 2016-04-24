<?php

namespace BDS\CalendrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendrier
 *
 * @ORM\Table(name="bds_calendrier")
 * @ORM\Entity(repositoryClass="BDS\CalendrierBundle\Entity\CalendrierRepository")
 */
class Calendrier
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;
    
    /**
     * @ORM\ManyToMany(targetEntity="BDS\EvenementBundle\Entity\Evenement", mappedBy="Calendriers")
     */
    private $evenements;
    
    /**
     * @ORM\ManyToMany(targetEntity="BDS\UserBundle\Entity\User", mappedBy="Calendriers")
     */
    private $users;


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
     * @return Calendrier
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
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Calendrier
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evenements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add evenement
     *
     * @param \BDS\EvenementBundle\Entity\Evenement $evenement
     *
     * @return Calendrier
     */
    public function addEvenement(\BDS\EvenementBundle\Entity\Evenement $evenement)
    {
        $this->evenements[] = $evenement;

        return $this;
    }

    /**
     * Remove evenement
     *
     * @param \BDS\EvenementBundle\Entity\Evenement $evenement
     */
    public function removeEvenement(\BDS\EvenementBundle\Entity\Evenement $evenement)
    {
        $this->evenements->removeElement($evenement);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * Add user
     *
     * @param \BDS\UserBundle\Entity\User $user
     *
     * @return Calendrier
     */
    public function addUser(\BDS\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \BDS\UserBundle\Entity\User $user
     */
    public function removeUser(\BDS\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
