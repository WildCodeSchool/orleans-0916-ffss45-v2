<?php

namespace FrontBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType ;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FormulaireSecoursType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomManif', TextType::class, array('label' => 'Nom de la manifestation'))
            ->add(
                'PresentationManif',
                TextareaType::class,
                array('label' => 'Brève description de la manifestation')
            )
            ->add('dateDebutManif', DateType::class, array('label' => 'Date du début de la manifestation'))
            ->add('heureDebutManif', TimeType::class, array('label' => 'Heure du début de la manifestation'))
            ->add('dateFinManif', DateType::class, array('label' => 'Date de fin de la manifestation'))
            ->add('heureFinManif', TimeType::class, array('label' => 'Heure de fin de la manifestation'))
            ->add('adresseManif', TextType::class, array('label' => 'Adresse de la manifestation'))
            ->add('villeManif', TextType::class, array('label' => 'Ville'))
            ->add('pompiersLieu', TextType::class, array('label' => 'Adresse des pompiers les plus proches'))
            ->add('urgencesLieu', TextType::class, array('label' => 'Adresse des urgences les plus proches'))
            ->add('raisonSociale', TextType::class, array('label' => 'Raison sociale'))
            ->add('nomRep', TextType::class, array('label' => 'Nom du représentant légal'))
            ->add('telRep', NumberType::class, array('label' => 'Téléphone du représentant légal'))
            ->add('mailRep', TextType::class, array('label' => 'Mail du représentant légal'))
            ->add('nomChef', TextType::class, array('label' => 'Nom du chef de projet'))
            ->add('telChef', NumberType::class, array('label' => 'Téléphone du chef de projet'))
            ->add('mailChef', EmailType::class, array('label' => 'Mail du chef de projet',))
            ->add('siteWeb', TextType::class, array('label' => 'Site web de la manifestation', 'required' => false))
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
                'label' => 'Document 1'
            ] )
            ->add('imageFile2', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
                'label' => 'Document 2'
            ])
            ->add('imageFile3', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
                'label' => 'Document 3'
            ])
            ->add('imageFile4', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
                'label' => 'Document 4'
            ])
            ->add('imageFile5', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
                'label' => 'Document 5'
            ])
            ->add(
                'typeManif',
                ChoiceType::class,
                array(
                    'label' => 'Votre manifestation',
                    'choices' => array(
                        'Culture (concert, festival, théâtre, cérémonie)' => 'culture',
                        'Sport (sous l égide d’une fédération ou non / compétition officielle ou de loisirs)' => 'sport',
                        'Rassemblement de personnes (brocante, foire, séminaire d’entreprise, soirée d’intégration)' => 'personnes',
                    ),
                    'expanded' => true,
                    'multiple' => false,
                    'choices_as_values' => true,
                )
            )
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
                'Dans un site public aménagé'=>'site public',
                'Dans un site privé aménagé'=>'site privé',
            ),
            'choices_as_values' => true,))
        ->add('nbPersoTotal', NumberType::class, array('label'=>'Nombre total de personnes attendues sur un jour'))
        ->add('nbPublicInsta', NumberType::class, array('label'=>'Nombre total de personnes attendues en instantané'))
        ->add('typeSiege', ChoiceType::class, array(
            'label'=> 'Les spectateurs assistent à votre évènement',
            'choices'=>array(
                'Debout dans une fosse'=>'fosse',
                'Dans des gradins fixes'=>'gradins fixes',
                'Dans des gradins temporaires'=>'gradins temporaires',
                'Sur des chaises'=>'chaises',
                'Autre'=>'autre',
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
            ->add('animation', TextareaType::class, array('label'=>'Quelles sont les principales animations proposées ?', 'required'=>false))
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
            ->add('federation', ChoiceType::class, array('label'=>'Votre manifestation est-elle sous l\'égide d\'une fédération sportive ?',
                                                         'choices'=> array(
                                                             'Oui'=>'oui',
                                                             'Non'=>'non'),
                                                         'choices_as_values' => true,
            ))
            ->add('regleFed',TextareaType::class, array('label'=>'Si oui, merci de préciser les obligations réglementaires','required'=>false))
            ->add('nbSportifs', NumberType::class, array('label'=>'Nombre de sportifs', 'required'=>false))
            ->add('nbPublicInsta', NumberType::class, array('label'=>'Nombre de public attendu en instantné'))
            ->add('licenceSportif', ChoiceType::class, array('label'=>'Les sportifs sont-ils licenciés ?',
                                                             'choices'=> array(
                                                                 'Oui'=>'oui',
                                                                 'Non'=>'non'),
                                                             'choices_as_values' => true,
            ))
            ->add('certifMedical', ChoiceType::class, array('label'=>'Si non, ont-ils un certificat médical ?',
                                                            'choices'=> array(
                                                                ''=>'vide',
                                                                'Oui'=>'oui',
                                                                'Non'=>'non'),
                                                            'choices_as_values' => true,
            ))
            ->add('typeEvtSportif', ChoiceType::class, array('label'=>'Il s\'agit',
                                                             'choices'=> array(
                                                                 'Course pédestre (trail, run and bike, courses, etc.)'=>'course',
                                                                 'Sport collectif (football, handball, basket-ball, etc)'=>'collectif',
                                                                 'Sport individuel (tennis, judo, karaté, bmx)'=>'individuel',
                                                                 'Sport mécanique (voiture, moto cross, moto vitesse, autre)'=>'mécanique',
                                                                 'Sport aquatique (natation, canoé, triathlon)'=>'aquatique',
                                                                 'Sport équestre (CSO, horse ball, polo, cross, autre)'=>'équestre',
                                                                 'Autre'=>'autre'),
                                                             'expanded'=>true,
                                                             'multiple'=>false,
                                                             'choices_as_values' => true,
                                                            'required'=>false,
            ))
            ->add('typeCourse', ChoiceType::class, array('label'=>'Type de course pédestre',
                                                         'choices'=> array(
                                                             'Trail'=>'trail',
                                                             'Run and Bike'=>'run and bike',
                                                             'Courses'=>'courses',
                                                             'Autre'=>'autre'),
                                                         'choices_as_values' => true,
            ))
            ->add('distParcours1', NumberType::class, array('label'=>'Distance du parcours 1 en km','required'=>false))
            ->add('distParcours2', NumberType::class, array('label'=>'Distance du parcours 2 en km','required'=>false))
            ->add('obstacles', ChoiceType::class, array('label'=>'Présence d\'obstacles',
                                                        'choices'=> array(
                                                            'Oui'=>'oui',
                                                            'Non'=>'non'),
                                                        'choices_as_values' => true,
            ))
            ->add('signaleur', ChoiceType::class, array('label'=>'Présence de signaleur',
                                                        'choices'=> array(
                                                            'Oui'=>'oui',
                                                            'Non'=>'non'),
                                                        'choices_as_values' => true,
            ))
            ->add('typePiste', ChoiceType::class, array('label'=>'Type de voie',
                                                        'choices'=> array(
                                                            'Piste'=>'piste',
                                                            'Chemin privé'=>'chemin privé',
                                                            'Voie publique'=>'voie publique'),
                                                        'choices_as_values' => true,
            ))
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire','required'=>false))
            ->add('typeSportCo', ChoiceType::class, array('label'=>'Type de sport collectif',
                                                          'choices'=> array(
                                                              'Football'=>'football',
                                                              'Basketball'=>'basketball',
                                                              'Handball'=>'handball',
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
            ->add('nbTerrains', IntegerType::class, array('label'=>'Nombre de terrains','required'=>false))
            ->add('catSportif', ChoiceType::class, array('label'=>'Vos sportifs sont en catégorie',
                                                         'choices'=> array(
                                                             'Jeunes'=>'jeunes',
                                                             'Espoirs'=>'espoirs',
                                                             'Séniors'=>'séniors',
                                                             'Vétérans'=>'vétérans'),
                                                         'choices_as_values' => true,
            ))
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire','required'=>false))
            ->add('typeSportIndiv', ChoiceType::class, array('label'=>'Type de sport individuel',
                                                             'choices'=> array(
                                                                 'Tennis'=>'tennis',
                                                                 'Judo'=>'judo',
                                                                 'Karate'=>'karate',
                                                                 'BMX'=>'bmx',
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
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire','required'=>false))
            ->add('typeSportMeca', ChoiceType::class, array('label'=>'Type de sport mécanique',
                                                            'choices'=> array(
                                                                'Voiture'=>'voiture',
                                                                'Motocross'=>'motocross',
                                                                'Moto vitesse'=>'moto vitesse',
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
            ->add('commissaire', ChoiceType::class, array('label'=>'Présence d\'un commissaire de piste ?',
                                                          'choices'=> array(
                                                              'Oui'=>'oui',
                                                              'Non'=>'non',
                                                          ),
                                                          'choices_as_values' => true,
            ))
            ->add('protection', ChoiceType::class, array('label'=>'Une protection du public est-elle prévue ?',
                                                         'choices'=> array(
                                                             'Oui'=>'oui',
                                                             'Non'=>'non',
                                                         ),
                                                         'choices_as_values' => true,
            ))
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire','required'=>false))
            ->add('typeSportMeca', ChoiceType::class, array('label'=>'Type de sport mécanique',
                                                            'choices'=> array(
                                                                'Voiture'=>'voiture',
                                                                'Motocross'=>'motocross',
                                                                'Moto vitesse'=>'moto vitesse',
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
            ->add('commissaire', ChoiceType::class, array('label'=>'Présence d\'un commissaire de piste ?',
                                                          'choices'=> array(
                                                              'Oui'=>'oui',
                                                              'Non'=>'non',
                                                          ),
                                                          'choices_as_values' => true,
            ))
            ->add('protection', ChoiceType::class, array('label'=>'Une protection du public est-elle prévue ?',
                                                         'choices'=> array(
                                                             'Oui'=>'oui',
                                                             'Non'=>'non',
                                                         ),
                                                         'choices_as_values' => true,
            ))
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire','required'=>false))
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
            ->add('typeSportEquestre', ChoiceType::class, array('label'=>'Type de sport équestre',
                                                                'choices'=> array(
                                                                    'CSO'=>'cso',
                                                                    'Horse ball'=>'horse ball',
                                                                    'Polo'=>'polo',
                                                                    'Cross'=>'cross',
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
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire','required'=>false))
            ->add('typeSportAutre', TextType::class, array('label'=>'Type de sport'))
            ->add('niveauCompet', ChoiceType::class, array('label'=>'Niveau de la compétition',
                                                           'choices'=> array(
                                                               'International'=>'international',
                                                               'National'=>'national',
                                                               'Régional'=>'régional',
                                                               'Départemental'=>'départemental',
                                                               'Loisirs'=>'loisirs'),
                                                           'choices_as_values' => true,
            ))
            ->add('ageSportif', NumberType::class, array('label'=>'Age moyen des pratiquants'))
            ->add('commentaire', TextareaType::class, array('label'=>'Commentaire','required'=>false))
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
