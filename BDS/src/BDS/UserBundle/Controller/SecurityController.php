<?php
namespace BDS\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;


class SecurityController extends BaseController
{
	protected function renderLogin (array $data)
	{	
		
		if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
		{
			//on appelle la page d'accueil si on est déjà identifié
			return $this->redirect($this->generateUrl('bds_news_home', array(
					'sport' => 'bds'
			)));
			
		}
		
		$reponse = parent::renderlogin($data);
		
		return $reponse;
		
	}
}