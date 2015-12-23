<?php

namespace BDS\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * News
 *
 * @ORM\Table(name="bds_news")
 * @ORM\Entity(repositoryClass="BDS\NewsBundle\Entity\NewsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class News
{
	/**
	 * @ORM\OneToMany(targetEntity="BDS\NewsBundle\Entity\Commentaire", mappedBy="news", cascade={"persist"}, orphanRemoval=true)
	 */
	private $commentaires;
	
	/**
	 * @ORM\ManyToMany(targetEntity="BDS\CoreBundle\Entity\Sport", inversedBy="News", cascade={"persist"})
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="resumer", type="string", length=255)
     */
    private $resumer;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;
    

    /**
     * @ORM\ManyToOne(targetEntity="BDS\UserBundle\Entity\User", inversedBy="news", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="datetime")
     */
    private $datePublication;
    
    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="date_edition", type="datetime", nullable=true)
     */
    private $dateEdition;
    
    /**
     * @ORM\OneToMany(targetEntity="BDS\NewsBundle\Entity\Validation", mappedBy="news", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
	private $validations;


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
     * Set titre
     *
     * @param string $titre
     * @return News
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set resumer
     *
     * @param string $resumer
     * @return News
     */
    public function setResumer($resumer)
    {
        $this->resumer = $resumer;

        return $this;
    }

    /**
     * Get resumer
     *
     * @return string 
     */
    public function getResumer()
    {
        return $this->resumer;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return News
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
     * Set auteur
     *
     * @param BDS\UserBundle\Entity\User $auteur
     * @return News
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return BDS\UserBundle\Entity\User 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return News
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }
    
    public function __construct()
    {
    	//par défaut la dete de l'annonce sera celle d'aujourd'hui
    	$this->datePublication = new \DateTime();
    	//on definit les sports
    	$this->sports = new ArrayCollection();
    	//on definit les commentaires
    	$this->comentaires = new ArrayCollection();
    	
    }

    /**
     * Add sports
     *
     * @param \BDS\CoreBundle\Entity\Sport $sports
     * @return News
     */
    public function addSport(\BDS\CoreBundle\Entity\Sport $sports)
    {
        $this->sports[] = $sports;
        
        foreach ($sports as $sport){
        	$sport->addNews($this);
        	
        }

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
        
        foreach ($sports as $sport){
        	$sport->removeNews($this);
        }
    }

    /**
     * Get sports
     *
     * @return BDS\CoreBundle\Entity\Sport
     */
    public function getSports()
    {
        return $this->sports;
    }

    /**
     * add validation
     *
     * @param BDS\NewsBundle\Entity\Validation $validation
     * @return News
     */
    public function addValidation($validation)
    {
        $this->validations[]=$validation;

        return $this;
    }

    /**
     * Remove validation
     *
     * @param \BDS\NewsBundle\Entity\validation $validation
     */
    public function removeValidation(\BDS\NewsBundle\Entity\Validation $validation)
    {
        $this->validations->removeElement($validation);
    }
    /**
     * Remove all validations
     *
     */
    public function removeAllValidations()
    {
        
        foreach($this->validations as $validation)
        {
            $this->validations->removeElement($validation);
        }
    }
    /**
     * Get validation
     *
     * @return BDS\NewsBundle\Entity\Validation 
     */
    public function getValidations()
    {
        return $this->validations;
    }    
    /**
     * Set validation
     *
     * @param BDS\NewsBundle\Entity\Validation $validations
     * @return News
     */
    public function setValidations($validations)
    {
        
        $this->validations=$validations;
        return $this;
    }


    /**
     * Add commentaires
     *
     * @param \BDS\NewsBundle\Entity\Commentaire $commentaires
     * @return News
     */
    public function addCommentaire(\BDS\NewsBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
        
        //on lit le la news au commentaire 
        $commentaires->setNews($this);

        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \BDS\NewsBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\BDS\NewsBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set dateEdition
     *
     * @param \DateTime $dateEdition
     * @return News
     */
    public function setDateEdition($dateEdition)
    {
        $this->dateEdition = $dateEdition;

        return $this;
    }

    /**
     * Get dateEdition
     *
     * @return \DateTime 
     */
    public function getDateEdition()
    {
        return $this->dateEdition;
    }

    /**
     * Set editeur
     *
     * @param \BDS\UserBundle\Entity\User $editeur
     * @return News
     */
    public function setEditeur(\BDS\UserBundle\Entity\User $editeur = null)
    {
        $this->editeur = $editeur;

        return $this;
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function updateNews()
    {
    	$this->setDateEdition(new \DateTime());
    	return $this;
    }

}
