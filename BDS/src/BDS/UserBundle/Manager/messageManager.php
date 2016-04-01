<?php

namespace BDS\UserBundle\Manager;

use Doctrine\ORM\EntityManager;

class MessageManager
{
	protected $em;
	
	public function __construct( EntityManager $em)
	{
		$this->em = $em;
	}
	
	public function getRepository()
	{
		return $this->em->getRepository('BDSUserBundle:Message');
	}
	
	public function triDate($listMessage)
	{
		//trouvver une idee pour trier par date 
	}
}