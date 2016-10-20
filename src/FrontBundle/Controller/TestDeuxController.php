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

class TestDeuxController extends Controller
{
    /**
     * @Route("/formulaire/test/new")
     */

    public function newForm3Action ($baseCommune, Request $request3)
    {


        $form3 = $this->createFormBuilder($baseCommune)


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
        if ($form3->isSubmitted() && $form3->isValid()) {

        }
        $form3->handleRequest($request3);
        dump($baseCommune);

        return $this->render('@Front/Default/form.html.twig', array(
            'form' => $form3->createView(),
        ));
    }


}