<?php

namespace BDS\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="bds_commentaire")
 * @ORM\Entity(repositoryClass="BDS\NewsBundle\Entity\CommentaireRepository")
 */
class Commentaire
{
	/**
	 * @ORM\ManyToOne(targetEntity="BDS\UserBundle\Entity\User", inversedBy="commentaires")
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
	 * @ORM\ManyToOne(targetEntity="BDS\NewsBundle\Entity\News", inversedBy="commentaires")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $news;
	
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
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;


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
     * Set contenu
     *
     * @param string $contenu
     * @return Commentaire
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
     * Set news
     *
     * @param \BDS\NewsBundle\Entity\News $news
     * @return Commentaire
     */
    public function setNews(\BDS\NewsBundle\Entity\News $news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \BDS\NewsBundle\Entity\News 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return Commentaire
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

    /**
     * Set auteur
     *
     * @param \BDS\UserBundle\User $auteur
     * @return Commentaire
     */
    public function setAuteur(\BDS\UserBundle\Entity\User $auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \BDS\UserBundle\User 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
    
    public function __construct()
    {
    	//par défaut la dete de l'annonce sera celle d'aujourd'hui
    	$this->datePublication = new \DateTime();
    }
}
