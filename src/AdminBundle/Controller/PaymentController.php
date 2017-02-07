<?php

namespace AdminBundle\Controller;

use CommerceBundle\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Formation controller.
 *
 * @Route("/payment")
 */
class PaymentController extends Controller
{

    /**
     * @Route("/", name="payment_index")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $payments = $em->getRepository('CommerceBundle:Panier')->findAll();

        return $this->render('payment/index.html.twig', array('payments' => $payments));
    }
    /**
     * @Route("/attente", name="payment_attente")
     *
     */
    public function attenteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $payments = $em->getRepository('CommerceBundle:Panier')->findByPaid(null);

        return $this->render('payment/index.html.twig', array('payments' => $payments));
    }
    /**
     * @Route("/nb-payment-attente", name="nb_payment_attente")
     *
     */
    public function nbPaymentAttenteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $payments = $em->getRepository('CommerceBundle:Panier')->findByPaid(null);

        return new Response(count($payments));
    }


     /**
     * @Route("/{id}/valid", name="payment_validation")
     *
     */
    public function validPaymentAction(Panier $payment) {
        $em = $this->getDoctrine()->getManager();
        $validRes = $this->get('commerce.payment.validation');
        $panier = json_decode($payment->getJson(), true);
        $validRes->saveReservation($panier, $payment->getNumeroReservation());
        $payment->setPaid(1);
        $em->persist($payment);
        $em->flush();
        $this->addFlash('success', 'Le paiement a été validé et la réservation a été créée');
        return $this->redirectToRoute('payment_attente');

    }

//    /**
//     * @Route("/{id}", name="payment_show")
//     *
//     */
//    public function showAction(Panier $payment) {
//        $em = $this->getDoctrine()->getManager();
//        return $this->render('payment/index.html.twig', array('payment' => $payment));
//
//    }
}
