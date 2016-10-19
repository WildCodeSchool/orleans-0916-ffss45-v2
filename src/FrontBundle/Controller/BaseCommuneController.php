<?php


namespace FrontBundle\Controller;

use FrontBundle\Entity\BaseCommune;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Doctrine\Common\Collections\ArrayCollection;



class BaseCommuneController extends Controller
{
    /**
     * @Route("/formulaire")
     */


    public function newForm (Request $request)
    {
        $baseCommune = new BaseCommune();

        $form = $this->createFormBuilder($baseCommune)
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

            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $essai=$form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $essai2 = $this->getDoctrine()->getManager();
            $essai2->persist($essai);

            // $em->flush();

            return $this->forward('FrontBundle:Controller:TestController.php', $essai);
        }


        return $this->render('@Front/Default/form.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}