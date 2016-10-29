<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use AdminBundle\Entity\Formation;
use ActualiteBundle\Entity\Actualite;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="page_accueil_principale")
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

        return $this->render('@Front/Default/pageActus.html.twig', array('actualites' => $actualites));
    }

    /**
     * @Route("/formation/{nomCourt}", name="formation")
     */
    public function showAction(Formation $formation)
    {
        return $this->render('FrontBundle:Default:formation.html.twig', array('formation' => $formation));

    }

    /**
     * @Route("/", name="contact")
     */


}