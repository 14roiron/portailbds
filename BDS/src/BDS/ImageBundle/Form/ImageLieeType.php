<?php

namespace BDS\ImageBundle\Form;

use Symfony\Component\Form\AbstractType;
use SYmfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\Tests\String;

class ImageLieeType extends AbstractType
{
	/**
	 * @parma FormBuilderInterface $builder
	 * @param array $options
	 */
	
	public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
	{
		$builder
			->remove('nom')
			->remove('uploader')
			;
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'BDS\ImageBundle\Entity\Image'
		));
	}
	
	/**
	 * @return String
	 */
	public function getName()
	{
		return 'bds_imagebundle_liee';
	}
	
	public function getParent()
	{
		return new ImageType();
	}
}