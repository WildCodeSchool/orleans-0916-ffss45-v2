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

            ))
            ->add('pompiersDist', NumberType::class)
            ->add('pompiersDelai', TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',))
            ->add('urgencesLieu', TextType::class)
            ->add('urgencesDist', NumberType::class)
            ->add('urgencesDelai', TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',))
            ->add('raisonSociale', TextType::class)
            ->add('nomRep', TextType::class)
            ->add('telRep', NumberType::class)
            ->add('mailRep', EmailType::class)
            ->add('nomChef', TextType::class)
            ->add('telChef', NumberType::class)
            ->add('mailChef', EmailType::class)
            ->add('nomSiteWeb', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $baseCommune = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            return $this->redirectToRoute('task_success');
        }


        return $this->render('@Front/Default/form.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}