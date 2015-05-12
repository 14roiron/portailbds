<?php

namespace BDS\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BDS\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		//les noms d'utilisateur à créer
		$listNames = array('Alexandre', 'Marine', 'Anna');
		
		foreach ($listNames as $name)
		{
			//on créer un nouvel user
			$user = new User();
			
			//le nom d'utilisateur et le mot de passe sont identique
			$user->setUsername($name);
			$user->setPassword($name);
			
			//On ne se sert pas du sel pour l'instant 
			$user->setSalt('');
			
			//On definit uniquement le ROLE_USER qui est le role de base
			$user->setRoles(array('ROLE_USER'));
			
			//on le persiste
			$manager->persist($user);
		}
		
		//on declenche la persistence 
		$manager->flush();
	}
}