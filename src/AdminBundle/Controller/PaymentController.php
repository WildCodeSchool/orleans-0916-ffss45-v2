<?php

namespace AdminBundle\Controller;

use CommerceBundle\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\DataMapper\CheckboxListMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('waitingPayment', ChoiceType::class, [
                'choices' => ['wait' => 'Paiement en attente', 'all' => 'Tous les paiements'],
                'label'   => 'Paiements à afficher',

            ])
            ->add('input', TextType::class, [
                    'required' => false,
                    'label'    => 'Filtrer',
                    'attr'     => [
                        'placeholder' => 'par prénom, nom ou numéro de commande',
                    ],
                ]
            )
            ->getForm();

        $form->handleRequest($request);

        $waiting = 'wait';
        $input = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $waiting = $data['waitingPayment'];
            $input = $data['input'];
        }

        $payments = $em->getRepository('CommerceBundle:Panier')->findAllPaymentSorted($waiting, $input);

        return $this->render('payment/index.html.twig', array('payments' => $payments, 'form' => $form->createView()));
    }

//    /**
//     * @Route("/attente", name="payment_attente")
//     *
//     */
//    public function attenteAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//        $payments = $em->getRepository(Panier::class)->findByPaid(null, ['id' => 'DESC']);
//
//        return $this->render('payment/index.html.twig', array('payments' => $payments));
//    }

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
    public function validPaymentAction(Panier $payment)
    {
        $em = $this->getDoctrine()->getManager();
        $validRes = $this->get('commerce.payment.validation');
        $panier = json_decode($payment->getJson(), true);
        $validRes->saveReservation($panier, $payment->getNumeroReservation());
        $payment->setPaid(1);
        $em->persist($payment);
        $em->flush();
        $this->addFlash('success', 'Le paiement a été validé et la réservation a été créée');

        return $this->redirectToRoute('payment_index');

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
