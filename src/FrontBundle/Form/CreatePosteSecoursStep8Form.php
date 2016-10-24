<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 24/10/16
 * Time: 13:24
 */

namespace FrontBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreatePosteSecoursStep8Form extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    //Formulaire sports mecaniques
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeSportMeca', ChoiceType::class, array('label'=>'Type de sport mécanique',
                'choices'=> array(
                    'Voiture'=>'voiture',
                    'Motocross'=>'motocross',
                    'Moto vitesse'=>'moto vitesse',
                    'Autre'=>'autre'),
                'choices_as_values' => true,
            ))
            ->add('niveauCompet', ChoiceType::class, array('label'=>'Niveau de la compétition',
                'choices'=> array(
                    'International'=>'intertenational',
                    'National'=>'national',
                    'Régional'=>'régional',
                    'Départemental'=>'départemental',
                    'Loisirs'=>'loisirs'),
                'choices_as_values' => true,
            ))
            ->add('nbTerrains', IntegerType::class, array('label'=>'Nombre de terrains'))
            ->add('catSportif', ChoiceType::class, array('label'=>'Vos sportifs sont en catégorie',
                'choices'=> array(
                    'Jeunes'=>'jeunes',
                    'Espoirs'=>'espoirs',
                    'Séniors'=>'séniors',
                    'Vétérans'=>'vétérans'),
                'choices_as_values' => true,
            ))
            ->add('commissaire', ChoiceType::class, array('label'=>'Présence d\'un commissaire de piste ?',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non',
                    ),
                'choices_as_values' => true,
            ))
            ->add('protection', ChoiceType::class, array('label'=>'Une protection du public est-elle prévue ?',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non',
                ),
                'choices_as_values' => true,
            ))
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire'))
            ->add('save', SubmitType::class, array('label' => 'Suivant'))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontBundle\Entity\FormulaireSecours'
        ));
    }
    public function getBlockPrefix()
    {
        return 'createPosteSecoursStep8';
    }
}