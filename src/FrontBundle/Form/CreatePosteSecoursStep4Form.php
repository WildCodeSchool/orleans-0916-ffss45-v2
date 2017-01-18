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
            ->add('regleFed',TextareaType::class, array('label'=>'Si oui, merci de préciser les obligations réglementaires','required'=>false))
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
                    'Course pédestre (trail, run and bike, courses, etc.)'=>'course',
                    'Sport collectif (football, handball, basket-ball, etc)'=>'collectif',
                    'Sport individuel (tennis, judo, karaté, bmx)'=>'individuel',
                    'Sport mécanique (voiture, moto cross, moto vitesse, autre)'=>'mécanique',
                    'Sport aquatique (natation, canoé, triathlon)'=>'aquatique',
                    'Sport équestre (CSO, horse ball, polo, cross, autre)'=>'équestre',
                    'Autre'=>'autre'),
                'expanded'=>true,
                'multiple'=>false,
                'choices_as_values' => true,
            ))
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