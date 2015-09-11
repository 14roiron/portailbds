<?php

namespace BDS\EvenementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class LieuVirtuelType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('address', null, array(
				'required'      => true,
		))
		->add('locality', 'hidden', array(
				'required'      => false,
		))
		->add('country', 'hidden', array(
				'required'      => false
		))
		->add('lat', 'hidden', array(
				'required'      => false
		))
		->add('lng', 'hidden', array(
				'required'      => false
		))
		;
	}

	public function getDefaultOptions(array $options)
	{
		return array(
				'virtual'   => true, // Ici nous précisons que notre FormType est un champ virtuel
		);
	}

	public function getName()
	{
		return 'lieu_virtuel'; // Le nom de notre champ, il sera utilisé après
	}
}