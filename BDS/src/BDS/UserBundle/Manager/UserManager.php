<?php
namespace BDS\UserBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use BDS\UserBundle\BDSUserBundle;

class UserManager
{
	protected $em;
	protected $securityContext;
	
	public function __construct(EntityManager $em, SecurityContext $securityContext)
	{
		$this->em = $em;
		$this->securityContext = $securityContext;
	}
	
	public function getRepository()
	{
		return $this->em->getRepository('BDSUserBundle:User');
	}
	
}