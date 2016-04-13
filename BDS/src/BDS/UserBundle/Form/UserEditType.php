<?php

namespace BDS\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserEditType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->remove('current_password')
			->add('prenom',	'text')
			->add('nom',	'text')
			->add('sexe')
			;
	}
	
	public function getParent()
	{
		return 'FOS\UserBundle\Form\Type\ProfileFormType';
	}
	
	public function getBlockPrefix()
	{
		return 'bds_user_edit';
	}
	
	public function getName()
	{
		return $this->getBlockPrefix();
	}
}