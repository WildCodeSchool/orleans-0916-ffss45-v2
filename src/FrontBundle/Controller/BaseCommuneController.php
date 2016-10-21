<?php


namespace FrontBundle\Controller;

use FrontBundle\Entity\BaseCommune;
use FrontBundle\Form\BaseCommuneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;


class BaseCommuneController extends Controller
{
    /**
     * @Route("/formulaire", name="formulaire")
     */


    public function newFormAction (Request $request)
    {   $culture='';

        $baseCommune= New BaseCommune();
        $form = $this->createForm(BaseCommuneType::class, $baseCommune);

        $form->handleRequest($request);


       if ($form->isSubmitted() && $form->isValid()) {

            return $this->forward('FrontBundle:Culture:newForm', array('baseCommune'=>$baseCommune));
        }

        dump($baseCommune, $culture);
        return $this->render('@Front/Default/form.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}