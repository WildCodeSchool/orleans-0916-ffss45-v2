<?php
namespace CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Agenda;

class PanierController extends Controller
{
    /**
     * @Route("/add-panier/{id}", name="add_panier")
     */
    public function ajouterAction(Agenda $agenda, Request $request)
    {
        $session = $request->getSession();
        $panier=$session->get('panier');

        $doublon = 0;
        foreach ($panier as $value){
            if($value == $agenda->getId()){
                $doublon = 1;
            }
        }
        if($doublon == 0) {
            array_push($panier, $agenda->getId());
        }
        $session->set('panier',$panier);
        return $this->redirect($this->generateUrl('panier'));
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function panierAction( Request $request)
    {
        $session = $request->getSession();
      // $session->remove('panier');

        if (!$session->has('panier')) {
            $session->set('panier', array());
        }
        var_dump($session->get('panier'));
        die();

        return $this->render('@Commerce/Default/panier.html.twig');


    }
}