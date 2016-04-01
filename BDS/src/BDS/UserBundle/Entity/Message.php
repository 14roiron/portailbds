<?php

namespace BDS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="bds_message")
 * @ORM\Entity(repositoryClass="BDS\UserBundle\Entity\MessageRepository")
 */
class Message
{
	/**
	 * @ORM\ManyToOne(targetEntity="BDS\UserBundle\Entity\User", inversedBy="messages")
	 */
	private $destinataire;
	
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
	 * @ORM\Column(name="importance", type="string")
	 */
    private $importance;
    
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
     *
     * @return Message
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
     * Set destinataire
     *
     * @param \BDS\UserBundle\Entity\User $destinataire
     *
     * @return Message
     */
    public function setDestinataire(\BDS\UserBundle\Entity\User $destinataire = null)
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * Get destinataire
     *
     * @return \BDS\UserBundle\Entity\User
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /**
     * Set importance
     *
     * @param string $importance
     *
     * @return Message
     */
    public function setImportance($importance)
    {
        $this->importance = $importance;

        return $this;
    }

    /**
     * Get importance
     *
     * @return string
     */
    public function getImportance()
    {
        return $this->importance;
    }
}
