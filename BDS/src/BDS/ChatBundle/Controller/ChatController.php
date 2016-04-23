<?php

namespace BDS\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BDS\ChatBundle\Entity\Message;
use Symfony\Component\HttpFoundation\Response;

class ChatController extends Controller
{
	public function showAction($channel)
	{
		$updateInterval = $this->getParameter('bds_chat.update_interval');
		
		return $this->render('BDSChatBundle:Chat:show.html.twig', array(
				'updateInterval'	=>	$updateInterval,
				'channel' 			=> 	$channel
		));
	}
	
	public function postAction(Request $request, $channel)
	{
		$message = new Message();
		$message->setAuthor($this->getUser());
		$message->setChannel($channel);
		$message->setMessage($request->get('message'));
		$message->setInsertDate(new \DateTime());
		$this->get('bds_chat.manager')->save($message);
	
		return new Response('Successful');
	}
	
	public function listAction($channel)
	{
		$messages = $this->get('bds_chat.manager')->getChannel($channel, $this->getParameter('bds_chat.number_of_messages'));
	
		return $this->render('BDSChatBundle:Chat:list.html.twig', array(
				'messages'	=>	$messages
		));
	}
}
