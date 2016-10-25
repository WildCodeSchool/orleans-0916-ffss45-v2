<?php

namespace FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CreatePosteSecoursStep1Form extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    //Etape de base commune à tous les formulaires

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomManif', TextType::class, array('label'=>'Nom de la manifestation'))
            ->add('PresentationManif', TextareaType::class, array('label'=>'Brève description de la manifestation'))
            ->add('dateDebutManif', DateType::class, array('label'=>'Date du début de la manifestation'))
            ->add('heureDebutManif', TimeType::class, array('label'=>'Heure du début de la manifestation'))
            ->add('dateFinManif', DateType::class, array('label'=>'Date de fin de la manifestation'))
            ->add('heureFinManif', TimeType::class, array('label'=>'Heure de fin de la manifestation'))
            ->add('adresseManif', TextType::class, array('label'=>'Adresse de la manifestation'))
            ->add('villeManif', TextType::class, array('label'=>'Ville'))
            ->add('pompiersLieu', TextType::class, array('label'=>'Adresse des pompiers les plus proches'))
            ->add('urgencesLieu', TextType::class, array('label'=>'Adresse des urgences les plus proches'))
            ->add('raisonSociale', TextType::class, array('label'=>'Raison sociale'))
            ->add('nomRep', TextType::class, array('label'=>'Nom du représentant légal'))
            ->add('telRep', NumberType::class, array('label'=>'Téléphone du représentant légal'))
            ->add('mailRep', TextType::class, array('label'=>'Mail du représentant légal'))
            ->add('nomChef', TextType::class, array('label'=>'Nom du chef de projet'))
            ->add('telChef', NumberType::class, array('label'=>'Téléphone du chef de projet'))
            ->add('mailChef', EmailType::class, array('label'=>'Mail du chef de projet'))
            ->add('siteWeb', TextType::class, array('label'=>'Site web de la manifestation'))
            ->add('typeManif', ChoiceType::class, array(
                'label'=> 'Votre manifestation',
                'choices'=>array(
                    'Culture'=>'culture',
                    'Sport'=>'sport',
                    'Rassemblement de personnes'=>'personnes'
                ),
                'choices_as_values' => true,)
            )

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
        return 'createPosteSecoursStep1';
    }

}