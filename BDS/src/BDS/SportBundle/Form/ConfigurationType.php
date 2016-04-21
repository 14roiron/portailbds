<?php

namespace BDS\SportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BDS\ImageBundle\Form\ImageLieeType;

class ConfigurationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',		'text')
            ->add('contenu',	'textarea')
            ->add('sport',		'entity',	array(
            									'class'		=>	'BDSSportBundle:Sport',
            									'property'	=>	'nom',
            									'expanded'	=>	'true',
            									'multiple'	=>	false
            ))
            ->add('image',		new ImageLieeType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BDS\SportBundle\Entity\Configuration'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bds_sportbundle_configuration';
    }
}
