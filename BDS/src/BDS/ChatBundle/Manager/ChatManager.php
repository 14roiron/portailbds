<?php

namespace BDS\ChatBundle\Manager;

use Doctrine\ORM\EntityManager;
use BDS\ChatBundle\Entity\Message;

class ChatManager
{
	protected $em;
	
	public function __construct (EntityManager $em)
	{
		$this->em = $em;
	}
	
	public function getRepository()
	{
		return $this->em->getRepository('BDSChatBundle:Message');
	}
	
	public function getChannel($channel, $parameter)
	{
		$list = $this->getRepository()->findBy(
											array('channel' => $channel),
											array('id' => 'desc'),
											$parameter
												);
		
		if ($list == NULL)
		{
			return [];
		} else {
			return $list;
		}
	}
	
	public function save(Message $message)
	{
		$this->em->persist($message);
		$this->em->flush();
	}
}