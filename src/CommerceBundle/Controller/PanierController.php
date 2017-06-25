<?php
namespace CommerceBundle\Controller;

use CommerceBundle\CommerceBundle;
use CommerceBundle\Form\ChoixPaymentType;
use FrontBundle\Entity\FormulaireSecours;
use FrontBundle\FrontBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AdminBundle\Entity\Formation;
use AdminBundle\Form\FormationType;
use AdminBundle\Form\AgendaType;
use Symfony\Component\HttpFoundation\File\File;
use AdminBundle\Entity\User;
use CommerceBundle\Entity\Reservation;
use Symfony\Component\Security\Acl\Exception\Exception;
use Tlconseil\SystempayBundle\Service\SystemPay;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use CommerceBundle\Entity\Panier;
use Tlconseil\SystempayBundle\TlconseilSystempayBundle;

class PanierController extends Controller
{
    /**
     * @Route("/add-panier/{id}", name="add_panier")
     */
    public function ajouterAction(Agenda $agenda)
    {
        $session = new Session();
        if (!$session->has('panier')) {
            $session->set('panier', []);
        }
        if (!is_array($session->get('panier'))) {
            $session->set('panier', []);
        }
        $em = $this->getDoctrine()->getManager();

        $panier = $session->get('panier');
        if (is_array($panier)) {
            if (!array_key_exists($agenda->getId(), $panier)) {
                $panier[$agenda->getId()] = ['agenda' => $agenda, 'formation' => $agenda->getFormation()->getNomLong(), 'quantity' => 1, 'inscrits' => null];
            }
        }
        $session->set('panier', $panier);

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
            $session->set('panier', []);
        }
        if (!$session->has('totalLivraison')) {
            $session->set('totalLivraison', false);
        }
        $panier = $session->get('panier');
        $totalLivraison = 0;
        $prixLivraison = 5;

        $totalfinal = 0;
        if (is_array($panier)) {
            foreach ($session->get('panier') as $id => $article) {
                $agenda = $em->getRepository('AdminBundle:Agenda')->find($id);
                $panier[$agenda->getId()]['totalitem'] = $agenda->getFormation()->getPrix() * $article['quantity'];
                if ($session->get('totalLivraison')) {
                    $totalLivraison = $prixLivraison * $article['quantity'];
                }
                $totalfinal += $panier[$agenda->getId()]['totalitem'] + $totalLivraison;

            }

        } else {
            $this->addFlash(
                'danger',
                'Le panier est vide, veuillez ajouter des formations'
            );
        }

        return $this->render('@Commerce/Default/panier.html.twig', array(
            'panier' => $panier, 'totalfinal' => $totalfinal,
        ));
    }


    /**
     * @Route("/quantityForm/{id}", name="qtform")
     */
    public function quantityFormAction(Agenda $agenda, Request $request)
    {
        for ($i = 1; $i <= 20; $i++) {
            $choices[$i] = $i;
        }
        $session = $request->getSession();
        $panier = $session->get('panier');

        $order = new Order();

        $form = $this->createFormBuilder($order)
            ->add('quantity', ChoiceType::class, array('label' => false, 'choices' => $choices, 'data' => $panier[$agenda->getId()]['quantity']))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $qte = $order->getQuantity();
            $panier[$agenda->getId()]['quantity'] = $qte;
            $session->set('panier', $panier);

            return $this->redirectToRoute('panier');
        }

        return $this->render('@Commerce/Default/quantityForm.html.twig', array(
            'form' => $form->createView(),
            'id'   => $agenda->getId(),
        ));
    }

    /**
     * @Route("/livraisonForm/", name="livraison")
     */
    public function livraisonFormAction(Request $request)
    {
        $session = $request->getSession();
        $totalLivraison = $session->get('totalLivraison');


        $panier = $session->get('panier');
        $nbInscrits = 0;
        foreach ($panier as $article) {
            $nbInscrits += $article['quantity'];
        }

        $order = new Order();
        $order->setLivraison(false);
        if ($session->get('checked')) {
            $order->setLivraison(true);
        }

        $form = $this->createFormBuilder($order)
            ->add('livraison', CheckboxType::class, [
                'label' => '5€ / inscrit',

            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();


            if ($order->getLivraison()) {
                $totalLivraison = true;
                $session->set('checked', true);
            } else {
                $totalLivraison = false;
                $session->set('checked', false);

            }

            $session->set('totalLivraison', $totalLivraison);

            return $this->redirectToRoute('panier');
        }

        return $this->render('@Commerce/Default/livraison.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/finalSubscription/{id_systempay}", name="final_subscription")
     *
     */
    public function finalSubscriptionAction($id_systempay, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        // connexion à la table systempay, avec parameter=identifiant de la transaction
//        $transaction = $em->getRepository('TlconseilSystempayBundle:Transaction')->find($id_systempay);
        $res = $em->getRepository('CommerceBundle:Panier')->findOneByNumeroReservation($id_systempay);
        if ($res) {
//            $log = json_decode($transaction->getLogResponse());
//            $paid = $transaction->isPaid();

//            $systempayOrderId = $log->vads_order_id;

            $panier = json_decode($res->getJson(), true);
            $orderId = $res->getNumeroReservation();

            if ($res && $panier) {
            // on passe le statut du panier à payé car CB (pas besoin de validation)
                $res->setType('cb');
                $res->setPaid(1);
                $em->persist($res);
//                dump($res);die('stop');
                $em->flush();
            // service permettant de créer les différents users liés à la réservation et de leur envoyer
            // un mail avec leur identifiants
                $validRes = $this->get('commerce.payment.validation');
                $validRes->saveReservation($panier, $orderId);
                $session->getFlashBag()->add('success', "Le paiement a été validé");

            } else {
                $session->getFlashBag()->add('danger', "Problème dans le traitement du panier");
            }
        }
        return $this->redirect($this->generateUrl('paiement_retour'));
    }


    /**
     * @Route("/finalSubscriptionPS/{id_systempay}", name="final_subscriptionPS")
     *
     */
    public function finalSubscriptionPSAction($id_systempay, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        // connexion à la table systempay, avec parameter=identifiant de la transaction
        $transaction = $em->getRepository('TlconseilSystempayBundle:Transaction')->find($id_systempay);
        if ($transaction) {
            $log = json_decode($transaction->getLogResponse());
            $paid = $transaction->isPaid();
            $systempayOrderId = $log->vads_order_id;

            $res = $em->getRepository('CommerceBundle:Panier')->findOneByNumeroReservation($systempayOrderId);
            $id_ps = json_decode($res->getJson(), true);
            $orderId = $res->getNumeroReservation();

            if ($res && $id_ps && $paid) {
                $res->setType('cb');
                $res->setPaid(1);
                $em->persist($res);

                $formSecours = $em->getRepository('FrontBundle:FormulaireSecours')>find($id_ps);
                $formSecours->setTypePayment('cb');
                $formSecours->setNumReservation($orderId);
                $em->persist($formSecours);
                $em->flush();

            } else {
                $session->getFlashBag()->add('danger', "Problème dans le traitement du panier");
            }
        }
        return $this->redirect($this->generateUrl('paiement_retour'));
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function deleteAction(Agenda $agenda, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        unset($panier[$agenda->getId()]);
        $session->set('panier', $panier);

        return $this->redirect($this->generateUrl('panier'));
    }

    /**
     * @Route("/empty-cart", name="empty_cart")
     */
    public function emptyCartAction(Request $request)
    {
        $session = $request->getSession();
        $session->set('panier', null);

        return $this->redirectToRoute('panier');
    }


    /**
     * @Route("/add-inscrit/{id}/{key}", name="add_inscrit")
     */
    public function addInscritAction(Agenda $agenda, $key, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $id = $agenda->getId();
        $form = $this->createForm('AdminBundle\Form\AddUserType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if (array_key_exists($id, $panier)) {
                if ($data['nom'] && $data['prenom'] && $data['email']) {

                    $panier[$id]['inscrits'][$key] = [
                        'nom'    => $data['nom'],
                        'prenom' => $data['prenom'],
                        'email'  => $data['email'],
                    ];
                }
            }
            $session->set('panier', $panier);

            //return $this->redirectToRoute('valid_cart');
        }

        return $this->render('@Commerce/Default/addInscrit.html.twig', array(
            'id'   => $id,
            'key'  => $key,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit-inscrit/{id}/{key}", name="edit_inscrit")
     */
    public function editInscritAction(Agenda $agenda, $key, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        //dump($panier);
        $id = $agenda->getId();
        if (isset($panier[$id]['inscrits'][$key])) {
            unset($panier[$id]['inscrits'][$key]);
        }
        $session->set('panier', $panier);

        return $this->redirectToRoute('valid_cart');

    }

    /**
     * @Route("/user-inscrit/{id}", name="user_inscrit")
     */
    public function userInscritAction(Agenda $agenda, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');


        $id = $agenda->getId();
        $user = $this->getUser();
        $panier[$id]['inscrits'][1] = ['nom' => $user->getNom(), 'prenom' => $user->getPrenom(), 'email' => $user->getEmail()];
        $session->set('panier', $panier);

        return $this->redirectToRoute('valid_cart');
    }


    /**
     * @Route("/valid-cart", name="valid_cart")
     */
    public function validateCartAction(Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $numCheque = uniqid(1, false);

        $form = $this->createForm(ChoixPaymentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $errorBack = 0;

            if ($panier) {
                foreach ($panier as $article) {
                    for ($i = 1; $i <= $article['quantity']; $i++) {
                        if (!isset($article['inscrits'])) {
                            $errorBack = 1;
                        } elseif (!array_key_exists($i, $article['inscrits'])) {
                            $errorBack = 1;
                        }
                    }
                }


                if ($errorBack) {
                    $this->addFlash(
                        'danger',
                        'Veuillez saisir les informations pour tous les inscrits'
                    );

                    return $this->redirectToRoute('valid_cart');

                }





                if ($data['payment']=='cb') {
                    return $this->redirectToRoute('pay_online');
                }
                else {
                    $em = $this->getDoctrine()->getManager();
                    $payment = new Panier();
                    $payment->setNumeroReservation($numCheque);
                    $payment->setJson(json_encode($panier));
                    $payment->setType($data['payment']);
                    $payment->setUser($this->getUser());
                    $infos = [];
                    $totalfinal=0;
                    $prixLivraison = 5;

                    foreach ($panier as $id => $article) {

                        $agenda = $em->getRepository('AdminBundle:Agenda')->find($id);

                        $panier[$agenda->getId()]['totalitem'] = $agenda->getFormation()->getPrix() * $article['quantity'];
                        $totalLivraison=0;
                        if ($session->get('totalLivraison')) {
                            $totalLivraison = $prixLivraison * $article['quantity'];
                        }
                        $totalfinal += $panier[$agenda->getId()]['totalitem'] + $totalLivraison;
                        $infos[]=$agenda->getFormation()->getNomCourt();

                        // envoi d'un mail à l'admin
                        $message = \Swift_Message::newInstance()
                            ->setSubject('FFSS45 Admin : Nouvelle demande de paiement à traiter')
                            ->setFrom($this->getParameter('mailer_user'))
                            ->setTo($this->getParameter('mailer_user'))
                            ->setBody('Nouvelle demande de paiement ('.$numCheque.') par : '.
                                $this->getUser()->getNom() .' '.
                                $this->getUser()->getPrenom().
                                ' pour la formation : '. $agenda->getFormation()->getNomCourt() .
                                'pour un montant de : '. $totalfinal .'€'
                            );
                        $this->get('mailer')->send($message);

                    }
                    $payment->setPrice($totalfinal);
                    if ($data['organism_info']) {
                        $infos[] = 'Organisme:'.$data['organism_info'];
                    }
                    $payment->setInformation(implode('; ', $infos));

                    $em->persist($payment);
                    $em->flush();

                    return $this->redirectToRoute('paiement_validation');
                }
            } else {
                $this->addFlash(
                    'danger',
                    'Le panier est vide, veuillez ajouter des formations'
                );

                return $this->redirectToRoute('panier');
            }


        }

        return $this->render('@Commerce/Default/validCart.html.twig', [
                'panier' => $panier,
                'numCheque'=>$numCheque,
                'form'   => $form->createView(),
            ]
        );

    }


    /**
     * @Route("/choix-paymentPS/{id}", name="choix_paymentPS")
     */
    public function choixPaymentAction(FormulaireSecours $formulaireSecours, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ChoixPaymentType::class);
        $form->handleRequest($request);
        $numCheque = uniqid();
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ($data['payment']=='cb') {
                return $this->redirectToRoute('pay_onlinePS', [
                    'id_ps' => $formulaireSecours->getId(),
                ]);
            } else {
                $formulaireSecours->setStatut(2);
                $formulaireSecours->setTypePayment($data['payment']);
                $formulaireSecours->setNumeroReservation($numCheque);

                $em->persist($formulaireSecours);
                $panier = new Panier();
                $panier->setNumeroReservation($numCheque);
                $panier->setJson($formulaireSecours->getId());
                $panier->setPosteDeSecours(1);
                $panier->setInformation($formulaireSecours->getNomManif());
                $panier->setPrice($formulaireSecours->getDevis());

                $em->persist($panier);

                $em->flush();
                $this->addFlash(
                    'success',
                    'Votre demande de payment a bien été pris en compte'
                );
                return $this->redirectToRoute('fos_user_profile_show');
            }
        }

        return $this->render('@Commerce/Default/validPS.html.twig', [
                'form' => $form->createView(),
                'numCheque'=>$numCheque,
            ]
        );

    }



    /**
     * @Route("/initiate-payment", name="pay_online")
     * @Template()
     */
    public function payOnlineAction(Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $em = $this->getDoctrine()->getManager();

        $totalLivraison = 0;
        $prixLivraison = 5;
        $totalfinal = 0;

        foreach ($panier as $id => $article) {

            $agenda = $em->getRepository('AdminBundle:Agenda')->find($id);
            $panier[$agenda->getId()]['totalitem'] = $agenda->getFormation()->getPrix() * $article['quantity'];
            if ($session->get('totalLivraison')) {
                $totalLivraison = $prixLivraison * $article['quantity'];
            }
            $totalfinal += $panier[$agenda->getId()]['totalitem'] + $totalLivraison;

        }
        $orderId = uniqid(1, false);

        $panier1 = new Panier();
        $panier1->setNumeroReservation($orderId);
        $panier1->setInformation('');
        $panier1->setPrice($totalfinal);
        $panier1->setUser($this->getUser());

        $panier1->setJson(json_encode($panier));

        $em->persist($panier1);
        $em->flush();

        $systempay = $this->get('tlconseil.systempay')
            ->init($currency = 978, $amount = ($totalfinal * 100))
            ->setOptionnalFields(array(
                'shop_url' => $this->getParameter('shop_url'),
                'order_id' => $orderId,
            ));

        return array(
            'paymentUrl' => $systempay->getPaymentUrl(),
            'fields'     => $systempay->getResponse(),
        );
    }

    /**
     * @Route("/initiate-paymentPS/{id_ps}", name="pay_onlinePS")
     */
    public function payOnlinePSAction($id_ps)
    {

        $em = $this->getDoctrine()->getManager();
        $ps = $em->getRepository('FrontBundle:FormulaireSecours')->find($id_ps);
        $montantPS = $ps->getDevis();
        $numDevis = uniqid(1, false);

        $panier = new Panier();
        $panier->setNumeroReservation($numDevis);
        $panier->setJson($id_ps);
        $panier->setPosteDeSecours(1);

        $em->persist($panier);
        $em->flush();

        $systempay = $this->get('tlconseil.systempay')
            ->init($currency = 978, $amount = ($montantPS * 100))
            ->setOptionnalFields(array(
                'shop_url' => $this->getParameter('shop_url'),
                'order_id' => $numDevis,
            ));
        return $this->render('@Commerce/Panier/payOnline.html.twig', array(
            'paymentUrl' => $systempay->getPaymentUrl(),
            'fields'     => $systempay->getResponse(),
        ));
    }

    /**
     * @Route("/payment/verification", name="payment_verification")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paymentVerificationAction(Request $request)
    {
        $this->get('tlconseil.systempay')
            ->responseHandler($request);

        $query = $request->request->all();

//        $id_systempay = (int)$query['vads_trans_id'];
        $id_systempay = (int)$query['vads_order_id'];

        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('CommerceBundle:Panier')->findOneByNumeroReservation($id_systempay);
        if ($commande) {
            if ($commande->getPosteDeSecours() == 1) {

                return $this->redirectToRoute('final_subscriptionPS', [
                    'id_systempay' => $id_systempay,
                ]);
            } else {

                return $this->redirectToRoute('final_subscription', [
                    'id_systempay' => $id_systempay,
                ]);
            }
        } else {
            $this->addFlash(
                'danger',
                'Problème lors de la validation du panier, veuillez recommencer'
            );
            return $this->redirectToRoute('panier');

        }
    }


    /**
     * @Route("/paiementValidation", name="paiement_validation")
     */
    public function paymentValidationAction(Request $request)
    {
        $session = $request->getSession();

        $session->remove('panier');

        return $this->render('CommerceBundle:Panier:panierValide.html.twig');
    }

    /**
     * @Route("/paiementRetour", name="paiement_retour")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stopSessionAction(Request $request)
    {
        $session = $request->getSession();

        $session->remove('panier');

        return $this->redirectToRoute('page_accueil_principale');
    }


}