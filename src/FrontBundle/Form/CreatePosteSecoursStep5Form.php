<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 20/10/16
 * Time: 17:42
 */

namespace FrontBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreatePosteSecoursStep5Form extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    //Formulaire courses pédestres

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeCourse', ChoiceType::class, array('label'=>'Type de course pédestre',
                'choices'=> array(
                    'Trail'=>'trail',
                    'Run and Bike'=>'run and bike',
                    'Courses'=>'courses',
                    'Autre'=>'autre'),
                'choices_as_values' => true,
            ))
            ->add('distParcours1', NumberType::class, array('label'=>'Distance du parcours 1 en km'))
            ->add('distParcours2', NumberType::class, array('label'=>'Distance du parcours 2 en km'))
            ->add('obstacles', ChoiceType::class, array('label'=>'Présence d\'obstacles',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non'),
                'choices_as_values' => true,
            ))
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
        return 'createPosteSecoursStep5';
    }

}