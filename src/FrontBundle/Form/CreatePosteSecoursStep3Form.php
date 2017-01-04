<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 20/10/16
 * Time: 17:42
 */

namespace FrontBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CreatePosteSecoursStep3Form extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    //Etape formulaire rassemblement de personnes

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeRdP', ChoiceType::class, array(
            'label'=> 'Type de rassemblement',
            'choices'=>array(
                'Brocante'=>'brocante',
                'Foire'=>'foire',
                'Séminaire ou soirée d\'entreprise'=>'séminaire ou entreprise',
                'Soirée ou gala étudiant'=>'soirée gala étudiant',
                'Comice agricole'=>'comice agricole',
                'Féria'=>'féria',
                'Carnaval'=>'carnaval',
                'Autre'=>'autre',
            ),
            'choices_as_values' => true,))
            ->add('animation', TextareaType::class, array('label'=>'Quelles sont les principales animations proposées ?'))
            ->add('prixEvt', ChoiceType::class, array(
                'label'=> 'Votre évènement est',
                'choices'=>array(
                    'Gratuit'=>'gratuit',
                    'Payant'=>'payant',
                ),
                'choices_as_values' => true,))
            ->add('evtIntExt', ChoiceType::class, array(
                'label'=> 'il s\'agit d\'un évènement en intérieur',
                'choices'=>array(
                    'Oui'=>'oui',
                    'Non'=>'non',
                ),
                'choices_as_values' => true,))
            ->add('typeSalle', ChoiceType::class, array(
                'label'=> 'Si votre évènement se déroule en intérieur',
                'choices'=>array(
                    ''=>'vide',
                    'Dans une salle de spectacle'=>'salle de spectacle',
                    'Dans une salle municipale'=>'salle municipale',
                    'Dans une salle des fêtes'=>'salle des fêtes',
                    'Dans une salle privée'=>'salle privée',
                ),
                'choices_as_values' => true,))
            ->add('typeSite', ChoiceType::class, array(
                'label'=> 'Sinon',
                'choices'=>array(
                    ''=>'vide',
                    'Sur la voie publique'=>'voie publique',
                    'dans un site public aménagé'=>'site public',
                    'Dans un site privé aménagé'=>'site privé',
                ),
                'choices_as_values' => true,))
            ->add('nbPersoTotal', NumberType::class, array('label'=>'Nombre total de personnes attendues sur un jour'))
            ->add('nbPublicInsta', NumberType::class, array('label'=>'Nombre total de personnes attendues en instantané'))
            ->add('mvtPublic', ChoiceType::class, array(
                'label'=> 'Les spectateurs assistent à votre évènement',
                'choices'=>array(
                    'Debout '=>'debout',
                    'Déambule'=>'déambule',
                    'Fixe'=>'fice',
                    'Dynamique'=>'dynamique',
                ),
                'choices_as_values' => true,))
            ->add('typePublic', ChoiceType::class, array(
                'label'=> 'La programmation est réalisée pour un public',
                'choices'=>array(
                    'Enfants'=>'enfants',
                    'Adolescents'=>'adolescents',
                    'Jeunes adultes'=>'jeunes adultes',
                    'adultes'=>'adultes',
                    'Séniors'=>'séniors',
                ),
                'choices_as_values' => true,))
            ->add('capaciteSite', NumberType::class, array('label'=>'La capacité du site en nombre de personnes'))
            ->add('superficieSite', NumberType::class, array('label'=>'La superficie du site en m²'))
            ->add('nbAcces', NumberType::class, array('label'=>'Le nombre d\'accès pour le public'))
            ->add('nbScene', NumberType::class, array('label'=>'Le nombre de scènes'))
            ->add('simulScene', ChoiceType::class, array(
                'label'=> 'Si plusieurs scènes, peuvent-elles jouer simultanément ?',
                'choices'=>array(
                    ''=>'vide',
                    'Oui'=>'oui',
                    'Non'=>'non',
                ),
                'choices_as_values' => true,))
            ->add('amenagTemp', ChoiceType::class, array(
                'label'=> 'Mettez-vous en place des aménagements temporaires ?',
                'choices'=>array(
                    ''=>'vide',
                    'Tente'=>'tente',
                    'Scène'=>'scène',
                    'Autre'=>'autre',
                ),
                'choices_as_values' => true,))
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
        return 'createPosteSecoursStep3';
    }

}