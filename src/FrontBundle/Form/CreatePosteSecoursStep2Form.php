<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 20/10/16
 * Time: 14:25
 */

namespace FrontBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CreatePosteSecoursStep2Form extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeEvtCulturel', ChoiceType::class, array(
                'label'=> 'Type d\'évènement culturel',
                'choices'=>array(
                    'Concert'=>'concert',
                    'Festival'=>'festival',
                    'Théâtre'=>'theatre',
                    'Autre'=>'autre',
                ),
                'choices_as_values' => true,))
            ->add('prixEvt', ChoiceType::class, array(
                'label'=> 'Votre évènement est',
                'choices'=>array(
                    'Gratuit'=>'gratuit',
                    'Payant'=>'payant',
                ),
                    'choices_as_values' => true,))
            ->add('typeEvtCulturel', ChoiceType::class, array(
                'label'=> 'Type d\'évènement culturel',
                'choices'=>array(
                    'Concert'=>'concert',
                    'Festival'=>'festival',
                    'Théâtre'=>'theatre',
                    'Autre'=>'autre',
                ),
                'choices_as_values' => true,))

            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontBundle\Entity\FormulaireSecours'
        ));
    }

    public function getBlockPrefix()
    {
        return 'createPosteSecoursStep2';
    }
}