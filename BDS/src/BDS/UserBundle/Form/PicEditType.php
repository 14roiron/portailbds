<?php

namespace BDS\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use BDS\ImageBundle\Form\ImageLieeType;

class PicEditType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->remove('prenom')
			->remove('nom')
			->remove('telephone')
			->remove('adresse')
			->remove('sexe')
			->remove('anniversaire')
			->remove('username')
			->remove('email')
			->add('profilePic', new ImageLieeType(),		array(
																'required'	=>	false
			));
	}
	
	public function getParent()
	{
		return 'BDS\UserBundle\Form\UserEditType';
	}
	
	public function getBlockPrefix()
	{
		return 'bds_user_pic';
	}
	
	public function getName()
	{
		return $this->getBlockPrefix();
	}
}