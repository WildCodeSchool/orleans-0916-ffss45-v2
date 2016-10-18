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
            ->add('nomManif', TextType::class)
            ->add('presentationManif', TextareaType::class)
            ->add('dateJour1', DateType::class)
            ->add('heureJour1',TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',))
            ->add('dateJour2', DateType::class)
            ->add('heureJour2',TimeType::class, array(
                    'input'  => 'datetime',
                    'widget' => 'choice',))
            ->add('dateJour3', DateType::class)
            ->add('heureJour3',TimeType::class, array(
                    'input'  => 'datetime',
                    'widget' => 'choice',))
            ->add('adresseManif', TextType::class)
            ->add('villeManif', TextType::class)
            ->add('pompiersLieu', TextType::class)
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
            ->getForm();

        return $this->render('@Front/Default/form.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}