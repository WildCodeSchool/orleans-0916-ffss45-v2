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

class CultureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeCulture', ChoiceType::class, array(
                'label'=> 'Votre manifestation',
                'choices'=>array(
                    'Concert'=>'concert',
                    'Festival'=>'festival',
                    'Théâtre'=>'theatre',
                    'Autre'=>'autre'
                ),
                'choices_as_values' => true,
            ))
            ->add('tarifCulture', ChoiceType::class, array(
                'label'=> 'Votre évènement est',
                'choices'=>array(
                    'Gratuit'=>'gratuit',
                    'Payant'=>'payant',
                ),
                'choices_as_values' => true,
            ))
            ->add('intExt', ChoiceType::class, array(
                'label'=> "Il s'agit d'un évènement en intérieur",
                'choices'=>array(
                    'Oui'=>'oui',
                    'Non'=>'non',
                ),
                'choices_as_values' => true,
            ))
            ->add('intLieu', ChoiceType::class, array(
                'label'=> 'Votre évènement se déroule dans',
                'choices'=>array(
                    'une salle de spectacle'=>'spectacle',
                    'une salle municipale'=>'municipale',
                    'une salle des fêtes privée'=>'privée',
                ),
                'choices_as_values' => true,
            ))
            ->add('extLieu', ChoiceType::class, array(
                'label'=> 'Votre évènement se déroule',
                'choices'=>array(
                    'sur la voie publique'=>'publique',
                    'dans un site public aménagé'=>'site public',
                    'dans un site privé aménagé'=>'site privé',
                ),
                'choices_as_values' => true,
            ))
            ->add('nbPersonneTotal1', NumberType::class, array(
                'label'=> 'Nombre de personnes au total pour le jour 1',
            ))
            ->add('nbPersonneInst1', NumberType::class, array(
                'label'=> 'Nombre de spectateurs en instantané pour le jour 1',
            ))
            ->add('nbPersonneTotal2', NumberType::class, array(
                'label'=> 'Nombre de personnes au total pour le jour 2',
            ))
            ->add('nbPersonneInst2', NumberType::class, array(
                'label'=> 'Nombre de spectateurs en instantané pour le jour 2',
            ))
            ->add('nbPersonneTotal3', NumberType::class, array(
                'label'=> 'Nombre de personnes au total pour le jour 3',
            ))
            ->add('nbPersonneInst3', NumberType::class, array(
                'label'=> 'Nombre de spectateurs en instantané pour le jour 3',
            ))
            ->add('typeSiege', ChoiceType::class, array(
                'label'=> 'Les spectateurs assistent à votre évènement',
                'choices'=>array(
                    'debout dans une fosse'=>'fosse',
                    'dans des gradins fixes'=>'gradins fixes',
                    'dans des gradins temporaires'=>'gradins temporaires',
                    'sur des chaises'=>'chaises',
                    'autre'=>'autre',
                ),
                'choices_as_values' => true,
            ))
            ->add('typePublic', ChoiceType::class, array(
                'label'=> 'La programmation est réalisée pour un public',
                'choices'=>array(
                    'enfants'=>'enfants',
                    'adolescents'=>'adolescents',
                    'jeunes adultes'=>'jeunes adultes',
                    'adultes'=>'adultes',
                    'séniors'=>'séniors',
                ),
                'choices_as_values' => true,
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
            'data_class' => 'FrontBundle\Entity\Culture'
        ));
    }
}