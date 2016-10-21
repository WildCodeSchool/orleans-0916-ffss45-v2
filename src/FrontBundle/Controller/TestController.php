<?php


namespace FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FrontBundle\Form\MedecinType;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends Controller
{
    /**
     * @Route("/formulaire/test/", name="test")
     */

    public function newFormDeuxAction ($baseCommune, $culture, Request $request)
    {

        $deux = $this->createFormBuilder(MedecinType::class);




        $deux->handleRequest($request);


        if ($deux->isSubmitted() && $deux->isValid() && !empty($deux)) {
            return $this->forward('FrontBundle:TestDeux:newForm3', array('baseCommune'=>$baseCommune));
        }
        dump($baseCommune, $culture);

        return $this->render('@Front/Default/form2.html.twig', array(
            'form2' => $deux->createView(),
        ));
    }


}