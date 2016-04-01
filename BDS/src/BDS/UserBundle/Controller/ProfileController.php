<?php
namespace BDS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use BDS\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class ProfileController  extends Controller
{
	public function showAction(User $user=null)
	{
		if( $user == null ) {
			$user = $this->get('security.context')->getToken()->getUser();
			/*if (!is_object($user) || !$user instanceof UserInterface) {
				throw new AccessDeniedException('This user does not have access to this section.');
			}*/
		}
		
		//on récupère les évènements auquels participe l'utilisateur 
		 
		return $this->render('BDSUserBundle:Profile:show_content.html.twig', array(
				'user' => $user
				
		));
		
	}
}