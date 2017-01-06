<?php

namespace CommerceBundle\Controller;

use CommerceBundle\Entity\Reservations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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

	/**
	 * @Route("/admin", name="admin_page")
	 */
	public function adminPageAction()
	{
		return $this->render('@Commerce/Default/admin.html.twig');
	}

	/**
	 * @Route("/client", name="client_page")
	 */
	public function clientPageAction()
	{
	return $this->render('@Commerce/Default/client.html.twig');

}

	/**
	 * @Route("/login_ok", name="login_ok")
	 * @security("has_role('ROLE_USER')")
	 */
	public function showInfoUserAction()
	{
		return $this->render('@Commerce/Default/login_success.html.twig');
	}

	/**
	 * @Route("/user", name="user_info")
	 * @security("is_granted('IS_AUTHENTICATED_FULLY')")
	 */
	public function showUserAction(Request $request)
	{
		IF($this->GET('security.authorization_checker')->isgranted('ROLE_ADMIN')) {
			return $this->render('CommerceBundle:Default:admin.html.twig');
		}
			IF($this->GET('security.authorization_checker')->isgranted('ROLE_USER')) {
				return $this->render('CommerceBundle:Default:client.html.twig');
			}
	}

	/**
	 * @Route("/who-is-user", name="user_question")
	 * @security("is_granted('IS_AUTHENTICATED_FULLY')")
	 */
	public function determineUser()
	{
		return $this->render('CommerceBundle:Default:user.html.twig');
	}




}
