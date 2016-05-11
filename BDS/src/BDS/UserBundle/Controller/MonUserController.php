<?php

namespace BDS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use BDS\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use BDS\UserBundle\BDSUserBundle;
use BDS\UserBundle\Form\PicEditType;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Ob\HighchartsBundle\Highcharts\Highchart;

class MonUserController  extends Controller
{
	public function MessageAction(User $user=null)
	{
		if( $user == null ) {
			$user = $this->get('security.context')->getToken()->getUser();
			
			if (!is_object($user) || !$user instanceof UserInterface) {
			 throw new AccessDeniedException('This user does not have access to this section.');
			 }
		}
		
		//on recupere tous les messages et on les trie par date 
		$messageList = $user->getMessages();
		$messageList = $this->get('bds_user.manager')->triDate($messageList);
		
		return $this->render('BDSUserBundle:monUser:message.html.twig', array(
				'messageList'	=>	$messageList,
				'user'			=>	$user
		));
	}
	
	public function StatsAction (User $user=null)
	{
		//on récupère l'utilisateur
		if ($user == null) 
		{
			$user = $this->get('security.context')->getToken()->getUser();
				
			if (!is_object($user) || !$user instanceof UserInterface) 
			{
				throw new AccessDeniedException('This user does not have access to this section.');
			}
		}
		
		//pour chaque sport 
		$membres = $user->getMembres();
		$evenements = array();
		$participations = array();
		$ob = array();
		foreach ($membres as $membre)
		{
			$sport = $membre->getSport();
			
			//compter le nombre de participation (s'il n'est pas égal c'est qu'il y a un bug)
			$participations[$sport->getNom()] = array();
			
			//faire l'inventaire des oui, non, peut-être
			$participations[$sport->getNom()][2] = 0;
			$participations[$sport->getNom()][1] = 0;
			$participations[$sport->getNom()][0] = 0;
			foreach ($membre->getParticipations() as $participation)
			{
				$etat = $participation->getParticipation();
				if($etat === false)
				{
					$participations[$sport->getNom()][0]++;
				} else if($etat === null){
					$participations[$sport->getNom()][2]++;
				} else if ($etat === true){
						$participations[$sport->getNom()][1]++;
				}
			}
			
			//on crée un graphique pour ces participations : 
			$ob[$membre->getId()] = new Highchart();
			$ob[$membre->getId()]->chart->renderTo('pie_'.$membre->getId());
			$ob[$membre->getId()]->title->text('participation aux evenements de '.$membre->getSport()->getNom());
			$ob[$membre->getId()]->plotOptions->pie(array(
					'allowPointSelect'  => true,
					'cursor'    => 'pointer',
					'dataLabels'    => array('enabled' => false),
					'showInLegend'  => false
			));
			$data = array(
					array('il était là', $participations[$sport->getNom()][1]),
					array('il était pas là', $participations[$sport->getNom()][0]),
					array("il s'en battait les couilles", $participations[$sport->getNom()][2])
			);
			$ob[$membre->getId()]->series(array(array('type' => 'pie','name' => 'nombre', 'data' => $data)));
		}
		
		//on retourne à la vue
		return $this->render('BDSUserBundle:Profile:stats.html.twig', array(
				'user'				=>	$user,
				'membres'			=>	$membres,
				'evenements'		=>	$evenements,
				'participations'	=>	$participations,
				'ob'				=>	$ob
		));
		
	}
	
	public function showAction(User $user=null)
	{
		if( $user == null ) {
			$user = $this->get('security.context')->getToken()->getUser();
			if (!is_object($user) || !$user instanceof UserInterface) {
				throw new AccessDeniedException('This user does not have access to this section.');
			}
		}
	
		//on récupère les évènements auquels participe l'utilisateur
			
		return $this->render('BDSUserBundle:Profile:show_content.html.twig', array(
				'user' => $user
	
		));
	}
	
	public function PicAction (Request $request)
	{
		//on récupère l'utilisateur courant 
		$user = $this->get('security.context')->getToken()->getUser();
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException('This user does not have access to this section.');
		}
		
		//on creer le formulaire 
		$form = $this->createForm(new PicEditType(), $user);
		
		//on fait le lien requete formulaire 
		$form->handleRequest($request);
		
		//on passe par une étape de validation 
		if ($form->isValid())
		{
			//on insert dans la bdd
			$this->get('bds_user.manager')->save($user);
			
			$request->getSession()->getFlashBag()->add('success', 'Votre photo de profil a bie été modifiée. ');
			
		} else {
			//il s'affiche tout le temps c'est pas normal 
			$request->getSession()->getFlashBag()->add('danger', "Le formulaire n'est pas valide.");
		}
		
		return $this->render('BDSUserBundle:MonUser:pic.html.twig', array(
				'form' =>	$form->createView()
		));
		
	}
}