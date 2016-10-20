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

class TestController extends Controller
{
    /**
     * @Route("/formulaire/test/", name="test")
     */

    public function newForm2Action ($baseCommune, Request $request)
    {


        $deux = $this->createFormBuilder($baseCommune)


        ->add('telChef', NumberType::class, array(
        'label'=>'téléphone',
    ))
        ->add('mailChef', EmailType::class, array(
            'label'=>'mail',
        ))
        ->add('nomSiteWeb', TextType::class, array(
            'label'=>'Site Web de l\'évènement',
        ))
        ->add('save', SubmitType::class, array('label' => 'Envoyer'))
        ->getForm();
        $deux->handleRequest($request);


        if ($deux->isSubmitted() && $deux->isValid() && !empty($deux)) {
            return $this->forward('FrontBundle:TestDeux:newForm3', array('baseCommune'=>$baseCommune));
        }
        dump($baseCommune);

        return $this->render('@Front/Default/form2.html.twig', array(
            'form2' => $deux->createView(),
        ));
    }


}