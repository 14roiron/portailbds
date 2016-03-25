<?php

namespace BDS\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BDS\CoreBundle\Entity\Sponsor;

class SponsorController extends Controller
{
	public function addAction(Request $request)
	{
		//on se place dans Admin 
		$domaine = $this->get('bds_sport.manager')->getSport('admin');
		
		//on crée un objet sponsor
		$sponsor = new Sponsor();
		
		
		
	}
	
	public function viewAction($id)
	{
		
	}
	
	public function deleteAction($id)
	{
		
	}
}