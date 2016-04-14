<?php

namespace BDS\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BDS\UserBundle\Entity\Membre;
use BDS\SportBundle\Entity\Sport;
use Symfony\Component\HttpFoundation\Tests\StringableObject;

class MembreType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $ builder
	 * @param array $option
	 */
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
			->add('sport',				'entity',		array(
															'class'			=>	'BDSSportBundle:Sport',
															'property'		=>	'nom',
															'expanded'		=>	true,
															'multiple'		=>	true,

			))
			;
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefauktOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'BDS\UserBundle\Entity\Membre'
		));
	}
	
	/**
	 * @return String
	 * 
	 */
	public function getName() 
	{
		return 'bds_userbundle_membre';
	}

}