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
//	    $enAttentes = $em->getRepository('FrontBundle:FormulaireSecours')->findByStatut('en attente');
//	    $enAttentePaiements = $em->getRepository('FrontBundle:FormulaireSecours')->findByStatut('en attente paiement');


        return $this->render('AdminBundle:Default:index.html.twig', array(
//        	'enAttentes' => $enAttentes,
//        	'enAttentesPaiements' => $enAttentePaiements,


        ));

    }


}


