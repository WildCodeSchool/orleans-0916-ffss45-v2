<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 24/10/16
 * Time: 13:24
 */

namespace FrontBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('nomMed', TextType::class, array('label'=>'Si oui et que vous en avez déja un, nom du médecin','required'=>false))
            ->add('prenomMed', TextType::class, array('label'=>'Prénom du médecin','required'=>false))
            ->add('contactMed', TextType::class, array('label'=>'Contact du médecin','required'=>false))
            ->add('speMed', TextType::class, array('label'=>'Spécialité', 'required'=>false))
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
            ->add('autresSecoursSamu', CheckboxType::class, ['required'=>false, 'label'=>'SAMU/SMUR', 'label_attr'=> ['class'=>'autreSecours']])
            ->add('autresSecoursAmbulance', CheckboxType::class, ['required'=>false, 'label'=>'Ambulance privée'])
            ->add('autresSecoursPompiers', CheckboxType::class, ['required'=>false, 'label'=>'Sapeurs pompiers'])
            ->add('autresSecoursGendarmerie', CheckboxType::class, ['required'=>false, 'label'=>'Police/gendarmerie'])
            ->add('autresSecoursPolice', CheckboxType::class, ['required'=>false, 'label'=>'Police municipale'])
            ->add('autresSecoursSociete', CheckboxType::class, ['required'=>false, 'label'=>'Société privée de sécurité'])
            ->add('autresSecoursAutre', CheckboxType::class, ['required'=>false, 'label'=>'Autres secours'])


            ->add('infosCompl', TextareaType::class, array('label'=>'Infos complémentaires','required'=>false))
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