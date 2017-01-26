<?php
namespace CommerceBundle\Controller;

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
                if ($session->get('totalLivraison')){
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
            'id' => $agenda->getId(),
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
     * @Route("/finalSubscription", name="final_subscription")
     */
    public function finalSubscriptionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        $panier = $session->get('panier');

        $n = 1;
        foreach ($panier as $formation) {

            $users = $em->getRepository('AdminBundle:User')->findAll();
            foreach ($users as $value) {
                $emails[] = $value->getEmail();
                $usernames[] = $value->getUserName();

            }
            $inscrits = ($formation['inscrits']);

            foreach ($formation['inscrits'] as $newUser) {
                $nom = $newUser['nom'];
                $prenom = $newUser['prenom'];
                $email = $newUser['email'];
                $password = $inscrits[$n]['password'] = uniqid(1, false);
                $n++;


                if (in_array($email, $emails)) {
                    $user = $em->getRepository('AdminBundle:User')->findOneByEmail($email);
                    //Enregistrer la formation dans le compte user

                } else {
                    $username = $prenom . $nom; //toto //toto2
                    $nb = 2;
                    while (in_array($username, $usernames)) {
                        $username = $prenom . $nom . $nb;
                        $nb++;
                    }

                    $passwordcrypt = md5($password);
                    $firstPassword[] = $password;

                    $userManager = $this->container->get('fos_user.user_manager');
                    $user = $userManager->createUser();
                    $user->setUsername($username);
                    $user->setEmail($email);
                    $user->setNom($nom);
                    $user->setPrenom($prenom);
                    $user->setPassword($passwordcrypt);

                    $userManager->updateUser($user);

                    //$user = $em->getRepository('AdminBundle:User')->findOneByEmail($email);
                   //$iduser = $user->getId();
                }
                $reservation = new Reservation();
                $reservation->setUser($user);

                $agenda = $formation['agenda'];
                $reservation->setAgenda($agenda);
//                dump($reservation);
                $em->persist($reservation);
            }
            $em->flush();

            foreach ($inscrits as $inscrit) {

                $message = \Swift_Message::newInstance()
                    ->setSubject('FFSS45 : Finaliser votre inscription')
                    ->setFrom('tuko45@hotmail.fr')
                    ->setTo($inscrit['email'])
                    ->setBody(
                        $this->renderView('emailSubscription.html.twig', array('nom' => $inscrit['nom'],
                            'prenom' => $inscrit['prenom'], 'password' => $inscrit['password']

                        ),
                            'text/html'
                        ));
                $this->get('mailer')->send($message);
            }
            return $this->redirect($this->generateUrl('succes'));
            // }
            // return $this->render('@Front/Default/acceuil.html.twig', array(
            //   'form' => $form->createView(),
            //));


        }
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

            //$data->setPassword(uniqid(1, false));

            if (array_key_exists($id, $panier)) {
                if ($data['nom'] && $data['prenom'] && $data['email']) {

                    $panier[$id]['inscrits'][$key] = [
                        'nom' => $data['nom'],
                        'prenom' => $data['prenom'],
                        'email' => $data['email'],
                    ];
                }
            }
            $session->set('panier', $panier);

            //return $this->redirectToRoute('valid_cart');
        }

        return $this->render('@Commerce/Default/addInscrit.html.twig', array(
            'id' => $id,
            'key' => $key,
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

        $id = $agenda->getId();
        if (isset($panier[$id]['inscrits'][$key])) {
            unset($panier[$id]['inscrits'][$key]);
        }
        $session->set('panier', $panier);

        return $this->render('@Commerce/Default/validCart.html.twig', array(
            'panier' => $panier,
        ));

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
//        dump($panier);

        return $this->render('@Commerce/Default/validCart.html.twig', array(
            'panier' => $panier,
        ));

    }

    /**
     * @Route("/payment", name="payment")
     */
    public
    function paymentAction(Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $errorBack = 0;
        if ($panier) {
            foreach ($panier as $article) {
                for ($i = 0; $i < $article['quantity']; $i++) {
                    if (!isset($article['inscrits'])) {
                        $errorBack = 1;
                    } elseif (!array_key_exists($i, $article['inscrits'])) {
                        $errorBack = 0;
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

            return $this->render('@Commerce/Default/payment.html.twig', array(
                'panier' => $panier,
            ));
        } else {
            $this->addFlash(
                'danger',
                'Le panier est vide, veuillez ajouter des formations'
            );

            return $this->redirectToRoute('panier');
        }
    }

    /**
     * @Route("/initiate-payment/id-{id}", name="pay_online")
     *
     */
    public function payOnlineAction($id)
    {
        // ...
        $systempay = $this->get('tlconseil.systempay')
            ->init()
            ->setOptionnalFields(array(
                'shop_url' => 'http://www.example.com'
            ));

        return $this->render('@Commerce/Default/payment.html.twig', array(
            'paymentUrl' => $systempay->getPaymentUrl(),
            'fields' => $systempay->getResponse(),
        ));
    }

    /**
     * @Route("/payment/verification")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paymentVerificationAction(Request $request)
    {
        // ...
        $this->get('tlconseil.systempay')
            ->responseHandler($request);

        return new Response();
    }

}