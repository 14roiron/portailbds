<?php

namespace BDS\EvenementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BDS\EvenementBundle\Form\ParticipationType;

class ParticipationEvenementType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			->remove('validationCapitaine')
			->remove('validationUser')
			->remove('evenement')
			->remove('membre')
		;
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
	{
		$resolver->setDefaults(array(
				'data_class'	=>	'BDS\EvenementBundle\Entity\Participation'
		));

	}

	/**
	 * @return string 
	 */
	public function getName()
	{
		return 'bds_evenementbundle_eventparticipation';
	}
	
	public function getParent()
	{
		return new ParticipationType();
	}
}