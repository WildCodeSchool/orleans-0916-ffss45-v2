<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Formation;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="acceuil")
     */
    public function indexAction()
    {
        return $this->render('FrontBundle:Default:index.html.twig');


    }
    /**
     * @Route("/page3")
     */
    public function page3Action()
    {
        return $this->render('FrontBundle:Default:formation.html.twig');


    }



}
