<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Formation;
use ActualiteBundle\Entity\Actualite;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="page_acceuil")
     */
    public function indexAction()
    {
        return $this->render('@Front/Default/acceuil.html.twig');


    }


    /**
     * @Route("/actualites", name="page_actualites")
     *
     */

    public function actusFrontAction()
    {
        $actualites = $this->getDoctrine()
            ->getRepository('ActualiteBundle:Actualite')
            ->findAll();

        return $this->render('@Front/Default/pageActus.html.twig', array('actualites'=>$actualites));
    }

    /**
     * @Route("/formation/{id}")
     */
    public function showAction(Formation $formation)
    {
        return $this->render('FrontBundle:Default:formation.html.twig', array('formation'=> $formation));

    }


    /**
     * @Route("/mentions-legales", name="mentionsLegales")
     */
    public function mentionsLegalesAction()
    {
        return $this->render('@Front/Default/mentionsLegales.html.twig');


    }
}
