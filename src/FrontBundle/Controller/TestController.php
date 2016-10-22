<?php


namespace FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FrontBundle\Form\MedecinType;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends Controller
{
    /**
     * @Route("/medecin", name="test")
     */

    public function medecinAction ($baseCommune, Request $request)
    {

        $form = $this->createFormBuilder(MedecinType::class, $baseCommune);




        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            return $this->forward('FrontBundle:TestDeux:newForm3', array('baseCommune'=>$baseCommune));
        }
        dump($baseCommune);

        return $this->render('@Front/Default/form2.html.twig', array(
            'form2' => $form->createView(),
        ));
    }


}