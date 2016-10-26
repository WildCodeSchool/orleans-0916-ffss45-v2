<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('formation', EntityType::class, array('class'=>'AdminBundle:Formation',
                                                        'choice_label'=>'nomCourt'))
            /*->add('remarque', TextType::class)*/
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
