<?php

namespace BDS\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BDS\SportBundle\Entity\Sport;

class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',				'text')
            ->add('resumer',			'text')
            ->add('contenu',			'textarea',
            array(
            'attr' => array(
            'class' => 'tinymce')))
            ->add('sports',				'entity',		array(
            												'class'			=>	'BDSSportBundle:Sport',
            												'property'		=>	'nom',
            												'multiple'		=>	true,
            												'expanded'		=>	true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BDS\NewsBundle\Entity\News',
        	'allow_extra_fields'	=>	true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bds_newsbundle_news';
    }
}
