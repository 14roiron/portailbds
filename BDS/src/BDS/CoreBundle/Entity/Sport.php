<?php

namespace BDS\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Config\Definition\BooleanNode;
use BDS\CoreBundle\Entity\Role;

/**
 * Sport
 *
 * @ORM\Table(name="bds_sport")
 * @ORM\Entity(repositoryClass="BDS\CoreBundle\Entity\SportRepository")
 */
class Sport
{
	/**
	 *@ORM\OneToMany(targetEntity="BDS\UserBundle\Entity\Membre", mappedBy="sport", cascade={"persist"}, orphanRemoval=true) 
	 */
	private $membres;
	
	/**
	 * @ORM\OneToMany(targetEntity="BDS\CoreBundle\Entity\Role", mappedBy="sport", cascade={"persist"}, orphanRemoval=true)
	 */
	private $roles;
	
	/**
	 * @ORM\ManyToMany(targetEntity="BDS\EvenementBundle\Entity\Evenement", mappedBy="sports")
	 */
	private $Evenements;
	
	/**
	 * @ORM\ManyToMany(targetEntity="BDS\NewsBundle\Entity\News", mappedBy="sports")
	 */
	private $News;
	
	/**
	 * @ORM\OneToOne(targetEntity="BDS\ImageBundle\Entity\Image", cascade={"persist"}, orphanRemoval=true)
	 */
	private $logo;
	
	/**
	 * @ORM\OneToOne(targetEntity="BDS\ImageBundle\Entity\Image", cascade={"persist"}, orphanRemoval=true)
	 */
	private $fond;
	
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
     * @var String
     * 
     * @ORM\Column(name="équipe", type="string", length=255)
     */
    private $equipe;


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
     * @return Sport
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
     * Constructor
     */
    public function __construct()
    {
        $this->News = new ArrayCollection();
        $this->roles = new ArrayCollection();
        
        //on ajoute les 4 roles par défaut 
        $joueur = new Role();
        $joueur->setNom("joueur");
        $joueur->setSport($this);
        $this->addRole($joueur);
        
        $ancien = new Role();
        $ancien->setNom("ancien");
        $ancien->setSport($this);
        $this->addRole($ancien);
        
        $entraineur = new Role();
        $entraineur->setNom("entraineur");
        $entraineur->setSport($this);
        $this->addRole($entraineur);
        
        $autre = new Role();
        $autre->setNom("autre");
        $autre->setSport($this);
        $this->addRole($autre);
        
        
        
    }

    /**
     * Add News
     *
     * @param \BDS\NewsBundle\Entity\News $news
     * @return Sport
     */
    public function addNews(\BDS\NewsBundle\Entity\News $news)
    {
        $this->News[] = $news;

        return $this;
    }

    /**
     * Remove News
     *
     * @param \BDS\NewsBundle\Entity\News $news
     */
    public function removeNews(\BDS\NewsBundle\Entity\News $news)
    {
        $this->News->removeElement($news);
    }

    /**
     * Get News
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->News;
    }

    /**
     * Set logo
     *
     * @param \BDS\ImageBundle\Entity\Image $logo
     * @return Sport
     */
    public function setLogo(\BDS\ImageBundle\Entity\Image $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \BDS\ImageBundle\Entity\Image 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Add evenements
     *
     * @param \BDS\EvenementBundle\Entity\Evenement $evenements
     * @return Sport
     */
    public function addEvenement(\BDS\EvenementBundle\Entity\Evenement $evenements)
    {
        $this->evenements[] = $evenements;

        return $this;
    }

    /**
     * Remove evenements
     *
     * @param \BDS\EvenementBundle\Entity\Evenement $evenements
     */
    public function removeEvenement(\BDS\EvenementBundle\Entity\Evenement $evenements)
    {
        $this->evenements->removeElement($evenements);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvenements()
    {
        return $this->Evenements;
    }

    /**
     * Set fond
     *
     * @param \BDS\ImageBundle\Entity\Image $fond
     * @return Sport
     */
    public function setFond(\BDS\ImageBundle\Entity\Image $fond = null)
    {
        $this->fond = $fond;

        return $this;
    }

    /**
     * Get fond
     *
     * @return \BDS\ImageBundle\Entity\Image 
     */
    public function getFond()
    {
        return $this->fond;
    }

    /**
     * Set equipe
     *
     * @param string $equipe
     * @return Sport
     */
    public function setEquipe($equipe)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return string 
     */
    public function getEquipe()
    {
        return $this->equipe;
    }

    /**
     * Set validationCapitaine
     *
     * @param boolean $validationCapitaine
     * @return Sport
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
     * Add membres
     *
     * @param \BDS\UserBundle\Entity\User $membres
     * @return Sport
     */
    public function addMembre(\BDS\UserBundle\Entity\User $membres)
    {
        $this->membres[] = $membres;

        return $this;
    }

    /**
     * Remove membres
     *
     * @param \BDS\UserBundle\Entity\User $membres
     */
    public function removeMembre(\BDS\UserBundle\Entity\User $membres)
    {
        $this->membres->removeElement($membres);
    }

    /**
     * Get membres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembres()
    {
        return $this->membres;
    }

    /**
     * Add roles
     *
     * @param \BDS\CoreBundle\Entity\Role $roles
     * @return Sport
     */
    public function addRole(\BDS\CoreBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;
        
        foreach ($roles as $role)
        {
        	$role->setSport($this);
        } 
		
        return $this;
    }

    /**
     * Remove roles
     *
     * @param \BDS\CoreBundle\Entity\Role $roles
     */
    public function removeRole(\BDS\CoreBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
