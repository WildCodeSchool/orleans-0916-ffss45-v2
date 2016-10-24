<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 24/10/16
 * Time: 13:24
 */

namespace FrontBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreatePosteSecoursStep6Form extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    //Formulaire courses pédestres
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeSportCo', ChoiceType::class, array('label'=>'Type de sport collectif',
                'choices'=> array(
                    'Football'=>'football',
                    'Basketball'=>'basketball',
                    'Handball'=>'handball',
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
            ->add('nbTerrains')
            ->add('signaleur', ChoiceType::class, array('label'=>'Présence de signaleur',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non'),
                'choices_as_values' => true,
            ))
            ->add('typePiste', ChoiceType::class, array('label'=>'Type de voie',
                'choices'=> array(
                    'Piste'=>'piste',
                    'Chemin privé'=>'chemin privé',
                    'Voie publique'=>'voie publique'),
                'choices_as_values' => true,
            ))
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire'))
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
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
        return 'createPosteSecoursStep6';
    }
}