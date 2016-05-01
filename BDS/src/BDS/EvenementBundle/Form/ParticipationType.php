<?php

namespace BDS\EvenementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParticipationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('participation',	'choice',	array( 'choices'	=>	array(
            															true	=>	'oui',
            															false	=>	'non',
            															null	=>	'aucun'),
            									'multiple'	=>	false,
            									'expanded'	=>	true
            ))
            ->add('commentaire')
            ->add('validationCapitaine')
            ->add('validationUser')
            ->add('evenement')
            ->add('membre')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BDS\EvenementBundle\Entity\Participation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bds_evenementbundle_participation';
    }
}
