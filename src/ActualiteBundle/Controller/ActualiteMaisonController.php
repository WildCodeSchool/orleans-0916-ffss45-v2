<?php

namespace ActualiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ActualiteBundle\Form\ActualiteType;
use Symfony\Component\HttpFoundation\Request;
use ActualiteBundle\Entity\Actualite;
class ActualiteMaisonController extends Controller
{
    public function findLastActuAction()
    {
        $actualites = $this->getDoctrine()
            ->getRepository('ActualiteBundle:Actualite')
            ->findBy(array(), array('id'=>'DESC'), 3);
        return $this->render('@Actualite/Default/lastActu.html.twig', array('actualites'=>$actualites));
    }

}

