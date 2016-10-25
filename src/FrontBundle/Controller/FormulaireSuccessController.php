<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 24/10/16
 * Time: 16:54
 */

namespace FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireSuccessController extends Controller
{

    /**
     * @Route("/succes", name="succes")
     */


    public function IndexAction()
    {
       return $this->render('@Front/Default/succes.html.twig');
    }
}