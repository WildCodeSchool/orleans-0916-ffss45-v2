<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgendaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDeDebut', 'date')
            ->add('dateDeFin', 'date')
            ->add('heureDeDebutAm', 'time')
            ->add('heureDeFinAm', 'time')
            ->add('heureDeDebutPm', 'time')
            ->add('heureDeFinPm', 'time')
            ->add('adresse')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Agenda'
        ));
    }
}
