<?php

namespace BDS\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BDS\ImageBundle\Form\ImageType;
use BDS\ImageBundle\Form\ImageLieeType;
use Doctrine\ORM\Mapping\Entity;
use BDS\UserBundle\BDSUserBundle;

class SportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',		'text')
            ->add('equipe',		'text',						array(
            													'required'	=> FALSE
            ))
            ->add('logo',		new ImageLieeType(),		array(
            													'required'	=> FALSE
            ))
            ->add('fond',		new ImagelieeType(),		array(
            													'required'	=>	FALSE
            ))
            ->add('capitaine',	'entity',					array(
            													'class'		=>	'BDSUserBundle:User',
            													'property'	=>	'username',
            													'multiple'	=>	false
            ));
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
     * @return string
     */
    public function getName()
    {
        return 'bds_corebundle_sport';
    }
}
