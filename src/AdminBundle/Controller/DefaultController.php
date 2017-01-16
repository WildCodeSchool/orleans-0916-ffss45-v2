<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin")
     */
    public function indexAction()
    {
	    $em = $this->getDoctrine()->getManager();
	    $formulaire_secours = $em->getRepository('FrontBundle:FormulaireSecours')->findByStatut('en attente');


        return $this->render('AdminBundle:Default:index.html.twig', array(
        	'formulaires' => $formulaire_secours,

        ));

    }


}


