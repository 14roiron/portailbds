<?php
namespace BDS\UserBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use BDS\UserBundle\BDSUserBundle;
use BDS\UserBundle\Entity\User;

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
	
	public function save(User $user)
	{
		$profilePic = $user->getProfilePic();
		//s'il elle existe il faut la sauvegarder 
		if($profilePic != null && $profilePic->getFile() != null)
		{
			$profilePic->setNom('profilePic_'.$user->getUsername());
			$profilePic->uploadImage();
		}
		
		$this->em->persist($user);
		$this->em->flush();
	}
}