<?php
namespace BDS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use BDS\UserBundle\Entity\User;

class SecurityController  extends Controller
{

	public function loginAction(Request $request)
  	{
    	// Si le visiteur est déjà identifié, on le redirige vers l'accueil
    	if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
     	 //on appelle la page d'accueil si on est déjà identifié
			return $this->redirect($this->generateUrl('bds_news_home', array(
					'sport' => 'bds'
			)));
    	}
    
    	// Le service authentication_utils permet de récupérer le nom d'utilisateur
    	// et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
    	// (mauvais mot de passe par exemple)
    	$authenticationUtils = $this->get('security.authentication_utils');

    	return $this->render('BDSUserBundle:Security:login.html.twig', array(
      		'last_username' => $authenticationUtils->getLastUsername(),
      		'error'         => $authenticationUtils->getLastAuthenticationError(),
    	));
  	}
  	
  	public function profilePicAction (User $user)
  	{	
  		return $this->render('BDSUserBundle:profile:pic.html.twig', array(
  				'user' => $user
  		));
  	}
	
}