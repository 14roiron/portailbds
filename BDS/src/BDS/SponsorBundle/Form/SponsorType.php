<?php

namespace BDS\SponsorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BDS\ImageBundle\Form\ImageLieeType;

class SponsorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('contactNom')
            ->add('contactPrenom')
            ->add('contactMail')
            ->add('contactTelephone')
            ->add('url')
            ->add('logo',				new ImageLieeType(),		array(
            															'required'	=>	FALSE
            ))
            ->add('sport',				'entity',					array(
            															'class'	=>	'BDSCoreBundle:sport',
            															'property'	=>	'nom',
            															'multiple'	=> false,
            															'expanded'	=> false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BDS\SponsorBundle\Entity\Sponsor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bds_sponsorbundle_sponsor';
    }
}
