<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 24/10/16
 * Time: 13:24
 */

namespace FrontBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CreatePosteSecoursStep9Form extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    //Formulaire sports aquatiques
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeSportAqua', ChoiceType::class, array('label'=>'Type de sport aquatique',
                'choices'=> array(
                    'Natation'=>'natation',
                    'Canoé'=>'canoe',
                    'Triathlon'=>'triathlon',
                    'Autre'=>'autre'),
                'choices_as_values' => true,
            ))
            ->add('niveauCompet', ChoiceType::class, array('label'=>'Niveau de la compétition',
                'choices'=> array(
                    'International'=>'international',
                    'National'=>'national',
                    'Régional'=>'régional',
                    'Départemental'=>'départemental',
                    'Loisirs'=>'loisirs'),
                'choices_as_values' => true,
            ))
            ->add('nbTerrains', IntegerType::class, array('label'=>'Nombre de terrains'))
            ->add('catSportif', ChoiceType::class, array('label'=>'Vos sportifs sont en catégorie',
                'choices'=> array(
                    'Jeunes'=>'jeunes',
                    'Espoirs'=>'espoirs',
                    'Séniors'=>'séniors',
                    'Vétérans'=>'vétérans'),
                'choices_as_values' => true,
            ))
            ->add('dispositifSecu', ChoiceType::class, array('label'=>'Présence d\'un dispositf de sécurité',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non',
                    ),
                'choices_as_values' => true,
            ))
            ->add('typePlanEau', ChoiceType::class, array('label'=>'Type de plan d\'eau',
                'choices'=> array(
                    'Fermé'=>'fermé',
                    'Ouvert'=>'ouvert',
                ),
                'choices_as_values' => true,
            ))
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
        return 'createPosteSecoursStep9';
    }
}