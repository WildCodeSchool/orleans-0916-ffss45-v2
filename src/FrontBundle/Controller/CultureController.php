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
        //$culture = new Culture();

        $baseCommune->setTypeCulture('zzzz');
        $form = $this->createFormBuilder(CultureType::class, $baseCommune);

        $form->handleRequest($request);


        //dump($form);

          if ($request) {

              return $this->forward('FrontBundle:Test:medecin',array('baseCommune'=>$baseCommune));
          }
          elseif ($request) {
              dump($form->getErrors());
exit();
          }


        return $this->render('@Front/Default/form2.html.twig', array(
            'form' => $form->createView(),
             ));

    }

}

