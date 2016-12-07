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

        if(!array_key_exists($agenda->getId(),$panier)){
            $panier[$agenda->getId()] = 1;
        }

        $session->set('panier',$panier);



        return $this->redirect($this->generateUrl('panier'));
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function panierAction( Request $request)

    {
        $em = $this->getDoctrine()->getManager();


        $session = $request->getSession();
        if (!$session->has('panier')) {
            $session->set('panier', array());
        }


        var_dump($session->get('panier'));
        $panier="";
        foreach ($session->get('panier') as $id=>$qte) {
          //  echo $key.'<br/>'.$qte;

          //  var_dump($ligne);
            $panier[] =array('agenda'=>($em->getRepository('AdminBundle:Agenda')->find($id)),'quantite'=>$qte);
        }
       // var_dump($agendas);
        return $this->render('@Commerce/Default/panier.html.twig', array(
            'panier' => $panier, 'qte'=>$qte

        ));


    }
}