<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Formation;
use AdminBundle\Entity\Categorie;
use AdminBundle\Entity\FormationPublic;

class ListFormationController extends Controller
{
    /**
     * @Route("/formations/{typeFormation}", name="acceuil")
     */
    public function indexAction($typeFormation)
    {
        $formations='';
        // $typeFormation='';
        $em = $this->getDoctrine()->getManager();
        $typeFormations = $em->getRepository('AdminBundle:FormationPublic')->findByType($typeFormation);
        //  var_dump($typeFormations);
        foreach($typeFormations as $typeFormation) {
            $categorie = $typeFormation->getCategorie();
            //$typeFormation and $categorie-> findAll($formations);
            // $categories = $em->getRepository('AdminBundle:Categorie')->findAll();
            //foreach ($categories as $categorie) {
            $nomCategorie = $categorie->getNomCategorie();
            $formations[$nomCategorie] = $em->getRepository('AdminBundle:Formation')->findByCategorie(array($categorie));
            //}
        }
        return $this->render('FrontBundle:ListFormation:index.html.twig', array('formations'=>$formations));


    }





}
