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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CreatePosteSecoursStep11Form extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    //Formulaire sports autres
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeSportAutre', TextType::class, array('label'=>'Type de sport'))
            ->add('niveauCompet', ChoiceType::class, array('label'=>'Niveau de la compétition',
                'choices'=> array(
                    'International'=>'international',
                    'National'=>'national',
                    'Régional'=>'régional',
                    'Départemental'=>'départemental',
                    'Loisirs'=>'loisirs'),
                'choices_as_values' => true,
            ))
           ->add('ageSportif', NumberType::class, array('label'=>'Age moyen des pratiquants'))
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire','required'=>false))
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
        return 'createPosteSecoursStep11';
    }
}