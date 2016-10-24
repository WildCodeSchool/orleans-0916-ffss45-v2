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

class CreatePosteSecoursStep4Form extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    //Formulaire commun évènements sportifs

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('federation', ChoiceType::class, array('label'=>'Votre manifestation est-elle sous l\'égide d\'une fédération sportive ?',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non'),
                'choices_as_values' => true,
                    ))
            ->add('regleFed',TextareaType::class, array('label'=>'Si oui, merci de préciser les obligations réglementaires'))
            ->add('nbSportifs', NumberType::class, array('label'=>'Nombre de sportifs'))
            ->add('nbPublicInsta', NumberType::class, array('label'=>'Nombre de public attendu en instantné'))
            ->add('licenceSportif', ChoiceType::class, array('label'=>'Les sportifs sont-ils licenciés ?',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non'),
                'choices_as_values' => true,
            ))
            ->add('certifMedical', ChoiceType::class, array('label'=>'Si non, ont-ils un certificat médical ?',
                'choices'=> array(
                    ''=>'vide',
                    'Oui'=>'oui',
                    'Non'=>'non'),
                'choices_as_values' => true,
            ))
            ->add('typeEvtSportif', ChoiceType::class, array('label'=>'Il s\'agit',
                'choices'=> array(
                    'Course pédestre'=>'course',
                    'Sport collectif'=>'collectif',
                    'Sport individuel'=>'individuel',
                    'Sport mécanique'=>'mécanique',
                    'Sport aquatique'=>'aquatique',
                    'Sport équestre'=>'équestre',
                    'Autre'=>'autre'),
                'choices_as_values' => true,
            ))
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
        return 'createPosteSecoursStep4';
    }

}