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

// findById($id);
          $session = $request->getSession();
//        if (!$session->has('panier')) {
//            $session->set('panier', array());
//        }
//
        $panier[] =$session->get('panier');
//
        foreach ($panier as $key=>$item) {
            if($item != $agenda->getId()){
                $panier['panier']=$agenda->getId();
            }
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
     //  $session->remove('panier');



        if (!$session->has('panier')) {
            $session->set('panier', array());

        }

        var_dump($session->get('panier'));
        die();

        return $this->render('@Commerce/Default/panier.html.twig');


    }
}