<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 24/10/16
 * Time: 13:24
 */

namespace FrontBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreatePosteSecoursStep12Form extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    //Formulaire fin
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('medecin', ChoiceType::class, array('label'=>'La règlementation ou votre structure souhaite la présence d\'un médecin sur place',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non',),
                'choices_as_values' => true,
            ))
            ->add('nomMed', TextType::class, array('label'=>'Nom du médecin'))
            ->add('prenomMed', TextType::class, array('label'=>'Prénom du médecin'))
            ->add('contactMed', TextType::class, array('label'=>'Contact du médecin'))
            ->add('prestaMed', ChoiceType::class, array('label'=>'Je souhaite que la FFSS me propose une prestation médicale',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non',),
                'choices_as_values' => true,
            ))
            ->add('pieceSecours', ChoiceType::class, array('label'=>'Vous mettez à disposition des secours une pièce ou structure fixe pour mettre en place le poste de secours',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non',
                ),
                'choices_as_values' => true,
            ))
            ->add('repasSecours', ChoiceType::class, array('label'=>'Vous prenez en charge les repas des équipes de secours',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non',
                ),
                'choices_as_values' => true,
            ))
            ->add('telSite', ChoiceType::class, array('label'=>'Une ligne téléphonique est disponible sur le site',
                'choices'=> array(
                    'Oui'=>'oui',
                    'Non'=>'non',
                ),
                'choices_as_values' => true,
            ))
            ->add('communicationSecours', TextType::class, array('label'=>'Quel moyen de communication est prévu pour joindre les secours ?'))
            ->add('autresSecours', ChoiceType::class, array('label'=>'Autres services présents',
                'choices'=> array(
                    'SAMU/SMUR'=>'samu',
                    'Ambulance privée'=>'ambulance',
                    'Sapeurs pompiers'=>'pompiers',
                    'Police/gendarmerie'=>'police/gendarmerie',
                    'Police municipale'=>'police municipale',
                    'Société privée de sécurité'=>'société privée',
                    'Aucun'=>'aucun',
                ),
                'choices_as_values' => true,
            ))
            ->add('infosCompl', TextareaType::class, array('label'=>'Infos complémentaires'))
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
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
        return 'createPosteSecoursStep12';
    }
}