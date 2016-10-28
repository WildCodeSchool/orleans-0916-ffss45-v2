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
use AdminBundle\Entity\FormationPublic;
use AdminBundle\Entity\Categorie;

class NavController extends Controller
{

    public function navProAction($typeFormation = 'professionnel')
    {
        $formations='';
        // $typeFormation='';
        $em = $this->getDoctrine()->getManager();
        $typeFormations = $em->getRepository('AdminBundle:FormationPublic')->findByType($typeFormation);
        foreach($typeFormations as $typeFormation) {
            $categorie = $typeFormation->getCategorie();
            $nomCategorie = $categorie->getNomCategorie();
            $formations[$nomCategorie] = $em->getRepository('AdminBundle:Formation')->findByCategorie(array($categorie));
        }
        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));


    }

    public function navParticulierAction($typeFormation = 'particulier')
    {
        $formations='';
        // $typeFormation='';
        $em = $this->getDoctrine()->getManager();
        $typeFormations = $em->getRepository('AdminBundle:FormationPublic')->findByType($typeFormation);
        foreach($typeFormations as $typeFormation) {
            $categorie = $typeFormation->getCategorie();
            $nomCategorie = $categorie->getNomCategorie();
            $formations[$nomCategorie] = $em->getRepository('AdminBundle:Formation')->findByCategorie(array($categorie));
        }
        return $this->render('@Front/Default/navContent.html.twig', array('formations'=>$formations));


    }
}