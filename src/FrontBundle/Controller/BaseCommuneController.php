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
     * @Route("/formulaire")
     */


    public function newFormAction (Request $request)
    {
        $form = $this->createForm(BaseCommuneType::class);

        $form->handleRequest($request);


      /*   if ($form->isSubmitted() && $form->isValid()) {

            return $this->forward('FrontBundle:Test:newForm2', array('route'=>'/src/FrontBundle/Controller/TestController.php'), array('baseCommune'=>$baseCommune));
        }*/


        return $this->render('@Front/Default/form.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}