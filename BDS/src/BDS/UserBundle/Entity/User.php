<?php 

namespace BDS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\HttpFoundation\Tests\StringableObject;
use Symfony\Component\Validator\Constraints\Date;
use Cunningsoft\ChatBundle\Entity\AuthorInterface;


/**
 * @ORM\Entity
 * 
 */
class User extends BaseUser implements AuthorInterface
{
	/**
	 * @var boolean
	 * 
	 * @ORM\Column(name="sexe", type="boolean")
	 */
	private $sexe;
	
	/**
	 * @ORM\OneToMany(targetEntity="BDS\UserBundle\Entity\Message", mappedBy="destinataire", cascade="persist", orphanRemoval=true)
	 */
	private $messages;
	
	/**
	 * @ORM\OneToOne(targetEntity="BDS\EvenementBundle\Entity\Lieu", cascade="persist", orphanRemoval=true)
	 */
	private $adresse;
	
	/**
	 * @ORM\OneToOne(targetEntity="BDS\ImageBundle\Entity\Image", cascade="persist", orphanRemoval=true)
	 */
	private $profilePic;
	
	/**
	 * @ORM\OneToMany(targetEntity="BDS\UserBundle\Entity\Membre", mappedBy="user", cascade="persist", orphanRemoval=true)
	 */
	private $membres;
	
	/**
	 * @ORM\OneToMany(targetEntity="BDS\NewsBundle\Entity\News", mappedBy="editeur")
	 */
	private $newsEdit;
	
	/**
	 * @ORM\OneToMany(targetEntity="BDS\NewsBundle\Entity\News", mappedBy="auteur")
	 */
	private $news;
	
	/**
	 * @ORM\OneToMany(targetEntity="BDS\NewsBundle\Entity\Commentaire", mappedBy="auteur")
	 */
	private $commentaires;
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="telephone", type="string")
	 */
	private $telephone;
	
	/**
	 * @var date
	 * 
	 * @ORM\Column(name="anniversaire", type="date", nullable=true)
	 */
	private $anniversaire;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="nom", type="string")
	 */
	private $nom;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="prenom", type="string")
	 */
	private $prenom;
	
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

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
     * Constructor
     */
    public function __construct()
    {
    	parent::__construct();
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add news
     *
     * @param \BDS\NewsBundle\Entity\News $news
     * @return User
     */
    public function addNews(\BDS\NewsBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \BDS\NewsBundle\Entity\News $news
     */
    public function removeNews(\BDS\NewsBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add commentaires
     *
     * @param \BDS\NewsBundle\Entity\Commentaire $commentaires
     * @return User
     */
    public function addCommentaire(\BDS\NewsBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;

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
     * Add newsEdit
     *
     * @param \BDS\NewsBundle\entity\News $newsEdit
     * @return User
     */
    public function addNewsEdit(\BDS\NewsBundle\entity\News $newsEdit)
    {
        $this->newsEdit[] = $newsEdit;

        return $this;
    }

    /**
     * Remove newsEdit
     *
     * @param \BDS\NewsBundle\entity\News $newsEdit
     */
    public function removeNewsEdit(\BDS\NewsBundle\entity\News $newsEdit)
    {
        $this->newsEdit->removeElement($newsEdit);
    }

    /**
     * Get newsEdit
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNewsEdit()
    {
        return $this->newsEdit;
    }

    /**
     * Add participations
     *
     * @param \BDS\EvenementBundle\Entity\Participation $participations
     * @return User
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


    /**
     * Get membres
     *
     * @return \BDS\UserBundle\Entity\Membre 
     */
    public function getMembres()
    {
        return $this->membres;
    }

    /**
     * Add membres
     *
     * @param \BDS\UserBundle\Entity\Membre $membres
     * @return User
     */
    public function addMembre(\BDS\UserBundle\Entity\Membre $membres)
    {
        $this->membres[] = $membres;

        return $this;
    }

    /**
     * Remove membres
     *
     * @param \BDS\UserBundle\Entity\Membre $membres
     */
    public function removeMembre(\BDS\UserBundle\Entity\Membre $membres)
    {
        $this->membres->removeElement($membres);
    }

    /**
     * Set profilePic
     *
     * @param \BDS\ImageBundle\Entity\Image $profilePic
     *
     * @return User
     */
    public function setProfilePic(\BDS\ImageBundle\Entity\Image $profilePic = null)
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    /**
     * Get profilePic
     *
     * @return \BDS\ImageBundle\Entity\Image
     */
    public function getProfilePic()
    {
        return $this->profilePic;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Add message
     *
     * @param \BDS\UserBundle\Entity\Message $message
     *
     * @return User
     */
    public function addMessage(\BDS\UserBundle\Entity\Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \BDS\UserBundle\Entity\Message $message
     */
    public function removeMessage(\BDS\UserBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set sexe
     *
     * @param boolean $sexe
     *
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return boolean
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set adresse
     *
     * @param \BDS\EvenementBundle\Entity\Lieu $adresse
     *
     * @return User
     */
    public function setAdresse(\BDS\EvenementBundle\Entity\Lieu $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \BDS\EvenementBundle\Entity\Lieu
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set anniversaire
     *
     * @param \DateTime $anniversaire
     *
     * @return User
     */
    public function setAnniversaire($anniversaire)
    {
        $this->anniversaire = $anniversaire;

        return $this;
    }

    /**
     * Get anniversaire
     *
     * @return \DateTime
     */
    public function getAnniversaire()
    {
        return $this->anniversaire;
    }
}
