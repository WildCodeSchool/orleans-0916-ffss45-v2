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
            ->add('typeManifSportive', ChoiceType::class, array(
                'label'=> 'type manifestation sportive',
                'choices'=>array(
                    'Aquatique'=>'aqua',
                    'Football'=>'foot',
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
            'data_class' => 'FrontBundle\Entity\PosteSecours'
        ));
    }

    public function getBlockPrefix()
    {
        return 'createPosteSecoursStep2';
    }
}