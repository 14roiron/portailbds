<?php

namespace BDS\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\Tests\String;

class SportEditType extends AbstractType
{
	/**
	 *@param FormBuilderInterface $builder
	 *@parma array options 
	 */
	
	public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
	{
		$builder
			->remove('ajouter')
			->add('modifier',		'submit')
		;

	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'BDS\CoreBundle\Entity\Sport'
		));
	}
	
	/**
	 * @return String
	 */
	public function getName()
	{
		return 'bds_corebundle_edit';
	}
	
	public function getParent()
	{
		return new SportType();
	}

}
