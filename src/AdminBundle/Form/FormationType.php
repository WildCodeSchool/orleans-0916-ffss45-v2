<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AdminBundle\Form\AgendaType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FormationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomLong')
            ->add('nomCourt')
            ->add('categorie', EntityType::class, array('class'=>'AdminBundle:Categorie',
                                                        'choice_label'=>'nomCategorie',
                                                        'required'=>false,
                                                        ))
            ->add('photo', FileType::class)
            ->add('descriptif')
            ->add ('publicVise')
            ->add ('objectifVise')
            ->add ('dureeFormation')
            ->add ('contenuFormation')
            ->add('methodePedagogique', TextAreaType::class, array( 'required' => false,))
            ->add ('validation')

        ;

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Formation'
        ));
    }
}
