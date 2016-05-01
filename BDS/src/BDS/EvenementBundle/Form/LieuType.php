<?php

namespace BDS\EvenementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LieuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numVoie',	'hidden')
            ->add('voie',		'hidden')
            ->add('zipcode',	'hidden')
            ->add('ville',		'hidden')
            ->add('region',		'hidden')
            ->add('pays',		'hidden')
            ->add('lat',		'hidden')
            ->add('lng',		'hidden')
            ->add('fullAdr')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BDS\EvenementBundle\Entity\Lieu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bds_evenementbundle_lieu';
    }
}
