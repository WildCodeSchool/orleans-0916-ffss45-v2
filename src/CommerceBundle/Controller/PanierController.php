<?php
namespace CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Agenda;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use CommerceBundle\Entity\Order;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
    public function panierAction(Request $request)

    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        if (!$session->has('panier')) {
            $session->set('panier', array());
        }


        var_dump($session->get('panier'));
        $panier = "";
        foreach ($session->get('panier') as $id => $qte) {
            //  echo $key.'<br/>'.$qte;

            //  var_dump($ligne);
            $panier[] = array('agenda' => ($em->getRepository('AdminBundle:Agenda')->find($id)), 'quantite' => $qte);

        }
        //var_dump($panier);
        return $this->render('@Commerce/Default/panier.html.twig', array(
            'panier' => $panier,

        ));
    }

    /**
     * @Route("/quantityForm", name="qtform")
     */
    public function quantityFormAction($id, Request $request)
    {
        for ($i = 1; $i<=10; $i++){
            $choices[$i]=$i;
        }
       // var_dump($choices);
        $session = $request->getSession();
        $panier = $session->get('panier');
     //   var_dump($panier);
        $order = new Order();
        $form = $this->createFormBuilder($order)
            ->add('quantity', ChoiceType::class, array('label'=>false, 'choices' => $choices, 'data'=>$panier[$id]))
            //->add('id', HiddenType::class, array('data' => $id))
            ->getForm();
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $panier[$id]=$data->getQte();
        }
        return $this->render('@Commerce/Default/quantityForm.html.twig', array(
            'form' => $form->createView(),

        ));
    }
}