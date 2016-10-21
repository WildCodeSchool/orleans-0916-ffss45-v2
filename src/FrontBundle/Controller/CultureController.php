<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 20/10/16
 * Time: 15:44
 */

namespace FrontBundle\Controller;

use FrontBundle\Entity\Culture;
use FrontBundle\Form\CultureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;


class CultureController extends Controller
{
    /**
     * @Route("/culture")
     */


    public function newFormAction ($baseCommune, Request $request)
    {
        $culture = new Culture();

        $form3 = $this->createForm(CultureType::class, $culture);

        $form3->handleRequest($request);


          if ($form3->isSubmitted() && $form3->isValid()) {

              return $this->forward('FrontBundle:Test:newFormDeux',array('baseCommune'=>$baseCommune,
                  'culture'=>$culture));
          }


        return $this->render('@Front/Default/form2.html.twig', array(
            'form' => $form3->createView(),
            dump($baseCommune, $culture) ));

    }

}

