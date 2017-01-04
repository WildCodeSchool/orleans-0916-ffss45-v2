<?php
namespace CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Agenda;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use CommerceBundle\Entity\Order;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AdminBundle\Form\AddUserType;
use Symfony\Component\HttpFoundation\Session\Session;



class PanierController extends Controller
{
    /**
     * @Route("/add-panier/{id}", name="add_panier")
     */
    public function ajouterAction(Agenda $agenda)
    {

        $session = new Session();

       // $session = $request->getSession();
        $panier=$session->get('panier');

        if (!is_array($panier)) {
            $panier = [];
        }
            if (!array_key_exists($agenda->getId(), $panier)) {
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

        $panier = "";
        $totalfinal = 0;
        foreach ($session->get('panier') as $id => $qte) {

            $agenda = $em->getRepository('AdminBundle:Agenda')->find($id);
            $panier[] = array('agenda' => $agenda, 'quantite' => $qte, 'totalitem' => $agenda->getFormation()->getPrix()*$qte);
            $totalfinal+=$agenda->getFormation()->getPrix()*$qte;

        }
       // var_dump($panier);
        return $this->render('@Commerce/Default/panier.html.twig', array(
            'panier' => $panier,  'totalfinal' => $totalfinal

        ));
    }

    /**
     * @Route("/quantityForm/{id}", name="qtform")
     */
    public function quantityFormAction($id, Request $request)
    {
        for ($i = 1; $i<=20; $i++){
            $choices[$i]=$i;
        }
        $session = $request->getSession();
        $panier = $session->get('panier');

        $order = new Order();
        $form = $this->createFormBuilder($order)
            ->add('quantity', ChoiceType::class, array('label'=>false, 'choices' => $choices, 'data'=>$panier[$id]))
           // ->add('nom', CollectionType::class, array(
          //      'entry_type'   => AddUserType::class,
           // ))
         //   ->add('prenom', ChoiceType::class, array('label'=>false, 'prenom' => $prenom, 'data'=>$panier[$id]))
            //->add('id', HiddenType::class, array('data' => $id))
            ->getForm();
        ;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $panier[$id]=$data->getQuantity();
            $session->set('panier',$panier);
            return $this->redirect($this->generateUrl('panier'));
        }
         return $this->render('@Commerce/Default/quantityForm.html.twig', array(
        'form' => $form->createView(),
        'id'=>$id
        ));
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function deleteFunction($id, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        unset($panier[$id]);
        $session->set('panier',$panier);
        return $this->redirect($this->generateUrl('panier'));
    }

}