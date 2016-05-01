<?php

namespace BDS\SportBundle\Form;

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
			))
			->add('urlVideo');
	}
	
	/**
	 *@param OptionResolverInterface $resolver
	 */
	public function steDefaultOption(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class'	=>	'BDS\SportBundle\Entity\Sport'
		));
	}
	
	/**
	 * @return string 
	 */
	public function getName()
	{
		return 'bds_SportBundle_presentation';
	}
	
	public function getParent()
	{
		return new SportType();
	}
}