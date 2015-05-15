<?php 

namespace BDS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * 
 */
class User extends BaseUser
{
	/**
	 * @ORM\OneToMany(targetEntity="BDS\EvenementBundle\Entity\Participation", mappedBy="user")
	 */
	private $participations;
	
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
}
