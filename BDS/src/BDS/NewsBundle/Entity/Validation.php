<?php

namespace BDS\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Validation
 *
 * @ORM\Table(name="bds_news_validation")
 * @ORM\Entity(repositoryClass="BDS\NewsBundle\Entity\ValidationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Validation
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
     * @var boolean
     *
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide=False;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="BDS\UserBundle\Entity\User", inversedBy="editeur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $editeur;

    /**
     * @ORM\ManyToOne(targetEntity="BDS\NewsBundle\Entity\News", inversedBy="news", cascade={"all"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $news;

    /**
     * @ORM\ManyToOne(targetEntity="BDS\CoreBundle\Entity\Sport", inversedBy="sport", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $sport;

    public function __construct()
    {
        //par défaut la dete de l'annonce sera celle d'aujourd'hui
        $this->date = new \DateTime();
    }


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
     * Set valide
     *
     * @param boolean $valide
     *
     * @return Validation
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Validation
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get editeur
     *
     * @return BDS\UserBundle\Entity\User
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set editeur
     *
     * @param BDS\UserBundle\Entity\User $editeur
     *
     * @return Validation
     */
    public function setEditeur($editeur)
    {
        $this->editeur = $editeur;

        return $this;
    }
    /**
     * Get news
     *
     * @return BDS\NewsBundle\Entity\News
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set news
     *
     * @param BDS\NewsBundle\Entity\News $news
     *
     * @return Validation
     */
    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }
    /**
     * Get Sport
     *
     * @return BDS\CoreBundle\Entity\Sport
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set sport
     *
     * @param BDS\CoreBundle\Entity\Sport $sport
     *
     * @return Validation
     */
    public function setSport($sport)
    {
        $this->sport = $sport;

        return $this;
    }
    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setDate(new \DateTime());
        return $this;
    }
}

