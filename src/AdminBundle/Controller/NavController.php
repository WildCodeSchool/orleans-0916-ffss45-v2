<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 23/10/16
 * Time: 10:23
 */

namespace AdminBundle\Controller;

use AdminBundle\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavController extends Controller
{
    public function formationDebutListAction()
    {
        $formations = $this->getDoctrine()
            ->getRepository('AdminBundle:Formation')
            ->findBy(array('categorie'=>'1'));


        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));
    }

    public function formationEquipeListAction()
    {
        $formations = $this->getDoctrine()
            ->getRepository('AdminBundle:Formation')
            ->findBy(array('categorie'=>'3'));


        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));
    }
    public function formationIncendieListAction()
    {
        $formations = $this->getDoctrine()
            ->getRepository('AdminBundle:Formation')
            ->findBy(array('categorie'=>'7'));


        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));
    }

    public function formationSanteListAction()
    {
        $formations = $this->getDoctrine()
            ->getRepository('AdminBundle:Formation')
            ->findBy(array('categorie'=>'6'));


        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));
    }

    public function formationSportifListAction()
    {
        $formations = $this->getDoctrine()
            ->getRepository('AdminBundle:Formation')
            ->findBy(array('categorie'=>'4'));


        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));
    }

    public function formationFormateurListAction()
    {
        $formations = $this->getDoctrine()
            ->getRepository('AdminBundle:Formation')
            ->findBy(array('categorie'=>'5'));


        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));
    }

    public function formationAquaListAction()
    {
        $formations = $this->getDoctrine()
            ->getRepository('AdminBundle:Formation')
            ->findBy(array('categorie'=>'8'));


        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));
    }

    public function formationTravailListAction()
    {
        $formations = $this->getDoctrine()
            ->getRepository('AdminBundle:Formation')
            ->findBy(array('categorie'=>'9'));


        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));
    }
}