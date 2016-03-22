<?php

namespace BDS\EvenementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MAJEvenementType extends AbstractType
{
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('participations',		'collection',		array('type'	=>	new ParticipationEvenementType()))
		->add('enregistrer', 		'submit')
		;
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class'	=>	'BDS\EvenementBundle\Entity\Evenement'
		));

	}
	
	public function getName()
	{
		return 'bds_evenementBundle_MAJ';
	}

}