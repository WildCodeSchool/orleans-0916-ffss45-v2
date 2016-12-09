<?php

namespace CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('CommerceBundle:Default:index.html.twig');
    }

	/**
	 * @Route("/connexion", name="connexion")
	 */
	public function connexionAction()
	{
		return $this->render('FOSUserBundle:Security:login.html.twig');
	}



}
