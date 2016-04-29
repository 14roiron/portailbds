<?php

namespace BDS\ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BDS\ChatBundle\Entity\AuthorInterface;

/**
 * Message
 *
 * @ORM\Table(name="bds_chat_message")
 * @ORM\Entity(repositoryClass="BDS\ChatBundle\Entity\MessageRepository")
 */
class Message
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
     * @var AuthorInterface
     *
     * @ORM\ManyToOne(targetEntity="AuthorInterface")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;
    
    /**
     * @var string
     *
     * @ORM\Column(name="channel", type="string", length=255)
     */
    private $channel;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertDate", type="datetime")
     */
    private $insertDate;


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
     * Set channel
     *
     * @param string $channel
     *
     * @return Message
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set insertDate
     *
     * @param \DateTime $insertDate
     *
     * @return Message
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;

        return $this;
    }

    /**
     * Get insertDate
     *
     * @return \DateTime
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * Set author
     *
     * @param \BDS\ChatBundle\Entity\AuthorInterface $author
     *
     * @return Message
     */
    public function setAuthor(\BDS\ChatBundle\Entity\AuthorInterface $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \BDS\ChatBundle\Entity\AuthorInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
