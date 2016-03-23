<?php

namespace BDS\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PresentationType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $option
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->remove('nom')
			->remove('equipe')
			->remove('logo')
			->remove('fond')
			->remove('capitaine')
			->add('presentation',		'textarea',		array(
															'attr' => array(
																		'class' => 'tinymce'
															)
			));
	}
	
	/**
	 *@param OptionResolverInterface $resolver
	 */
	public function steDefaultOption(OptionsResolverInterface $option)
	{
		$resolver->setDefaults(array(
				'data_class'	=>	'BDS\CoreBundle\Entity\Sport'
		));
	}
	
	/**
	 * @return string 
	 */
	public function getName()
	{
		return 'bds_corebundle_presentation';
	}
	
	public function getParent()
	{
		return new SportType();
	}
}