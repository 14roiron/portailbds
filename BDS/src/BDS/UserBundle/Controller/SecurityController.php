<?php
namespace BDS\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BasController;


class SecurityController extends BaseController
{
	protected function renderLogin (array $data)
	{	
		// On récupère l'utilisateur
		$security = $container->get('security.context');
		$token = $security->getToken();
		$user = $token->getUser();
		
		if ($user != null)
		{
			//on appelle la page d'accueil
			return $this->redirect($this->generateUrl('bds_news_home', array(
					'sport' => 'bds'
			)));
			
		}
		
		$reponse = parent::renderlogin($data);
		
		return $reponse;
		
	}
}