<?php

namespace BDS\EvenementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvenementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',					'text')
            ->add('debutEvenement',			'collot_datetime')
            ->add('finEvenement',			'collot_datetime')
            ->add('debutInscripsion',		'collot_datetime', array('required' => false))
            ->add('finInscripsion',			'collot_datetime', array('required' => false))
            ->add('info',					'text', array('required' =>false))
            ->add('maxInscrit',				'integer', array('required' => false))
            ->add('sports',					'entity',		array(
            													'class'		=>	'BDSCoreBundle:Sport',
            													'property'	=>	'nom',
            													'multiple'	=>	'true',
            													'expanded'	=>	'true',
            ))
            ->add('ajouter',				'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BDS\EvenementBundle\Entity\Evenement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bds_evenementbundle_evenement';
    }
}
