<?php

namespace FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class BaseCommuneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomManif', TextType::class, array(
                'label'=>'Nom de la manifestation',
            ))
            ->add('presentationManif', TextareaType::class, array(
                'label'=>'Courte description de la manifestation',
            ))
            ->add('dateJour1', DateType::class, array(
                'label'=>'Date et heure du premier jour',
            ))
            ->add('heureJour1',TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'label'=>' ',
            ))
            ->add('dateJour2', DateType::class, array(
                'label'=>'Date et heure du deuxième jour',
            ))
            ->add('heureJour2',TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'label'=>' ',
            ))
            ->add('dateJour3', DateType::class, array(
                'label'=>'Date et heure du troisième jour',
            ))
            ->add('heureJour3',TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'label'=>' ',
            ))
            ->add('adresseManif', TextType::class, array(
                'label'=>'Adresse de la manifestation',
            ))
            ->add('villeManif', TextType::class, array(
                'label'=>'Ville',
            ))
            ->add('pompiersLieu', TextType::class, array(
                'label'=>'Adresse des pompiers'
            ))
            ->add('pompiersDist', NumberType::class, array(
                'label'=>' Distance de la caserne'
            ))
            ->add('pompiersDelai', TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'label'=>'Délai avant intervention'))
            ->add('urgencesLieu', TextType::class, array(
                'label'=>'Adresse des urgences',
            ))
            ->add('urgencesDist', NumberType::class, array(
                'label'=>'Distance des Urgences',
            ))
            ->add('urgencesDelai', TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'label'=> 'Délai'
            ))
            ->add('raisonSociale', TextType::class, array(
                'label'=>'Raison sociale'
            ))
            ->add('nomRep', TextType::class, array(
                'label'=>'Nom du représentant',
            ))
            ->add('telRep', NumberType::class, array(
                'label'=>'téléphone'
            ))
            ->add('mailRep', EmailType::class, array(
                'label'=>'mail'
            ))
            ->add('nomChef', TextType::class, array(
                'label'=>'Nom du Chef de projet'
            ))
            ->add('telChef', NumberType::class, array(
                'label'=>'téléphone',
            ))
            ->add('mailChef', EmailType::class, array(
                'label'=>'mail',
            ))
            ->add('nomSiteWeb', TextType::class, array(
                'label'=>'Site Web de l\'évènement',
            ))
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontBundle\Entity\BaseCommune'
        ));
    }


}