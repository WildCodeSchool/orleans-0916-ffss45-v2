<?php

namespace FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PosteSecoursType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomManif')
            ->add('presentationManif')
            ->add('dateDebutManif')
            ->add('dateFinManif')
            ->add('heureDebutManif')
            ->add('heureFinManif')
            ->add('adresseManif')
            ->add('villeManif')
            ->add('pompiersLieu')
            ->add('urgencesLieu')
            ->add('raisonSociale')
            ->add('nomRep')
            ->add('telRep')
            ->add('mailRep')
            ->add('nomChef')
            ->add('telChef')
            ->add('mailChef')
            ->add('siteWeb')
            ->add('typeManif')
            ->add('federation')
            ->add('regleFed')
            ->add('nbSportifs')
            ->add('nbPublicInsta')
            ->add('licenceSportif')
            ->add('certifMedical')
            ->add('typeEvtSportif')
            ->add('typeCourse')
            ->add('distParcours1')
            ->add('distParcours2')
            ->add('obstacles')
            ->add('signaleur')
            ->add('typePiste')
            ->add('commentaire')
            ->add('typeSportCo')
            ->add('niveauCompet')
            ->add('nbTerrains')
            ->add('catSportif')
            ->add('typeSportIndiv')
            ->add('typeSportMeca')
            ->add('commissaire')
            ->add('protection')
            ->add('typeSportAqua')
            ->add('dispositifSecu')
            ->add('typePlanEau')
            ->add('typeSportEquestre')
            ->add('typeSportAutre')
            ->add('ageSportif')
            ->add('typeEvtCulturel')
            ->add('prixEvt')
            ->add('evtIntExt')
            ->add('typeSalle')
            ->add('typeSite')
            ->add('nbPersoTotal')
            ->add('typeSiege')
            ->add('typePublic')
            ->add('capaciteSite')
            ->add('superficieSite')
            ->add('nbAcces')
            ->add('nbScene')
            ->add('simulScene')
            ->add('amenagTemp')
            ->add('typeRdP')
            ->add('animation')
            ->add('mvtPublic')
            ->add('medecin')
            ->add('nomMed')
            ->add('prenomMed')
            ->add('speMed')
            ->add('contactMed')
            ->add('prestaMed')
            ->add('pieceSecours')
            ->add('repasSecours')
            ->add('telSite')
            ->add('communicationSecours')
            ->add('autresSecours')
            ->add('infosCompl')
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
}
