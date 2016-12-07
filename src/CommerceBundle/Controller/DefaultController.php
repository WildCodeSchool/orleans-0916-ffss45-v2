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
	 * @Route("/inscription", name="inscription")
	 */
	public function inscriptionAction()
	{
		return $this->render('FOSUserBundle:Security:login.html.twig');
	}

    /**
     * @Route("/inscription")
     */
    public function inscAction()
    {
        return $this->render('CommerceBundle:Default:inscription.html.twig');
    }

}
