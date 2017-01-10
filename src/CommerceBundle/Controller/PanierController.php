<?php
namespace CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Container;
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
use AdminBundle\Entity\Formation;
use AdminBundle\Form\FormationType;
use AdminBundle\Form\AgendaType;
use Symfony\Component\HttpFoundation\File\File;
use AdminBundle\Entity\User;
use FrontBundle\Entity\Contact;


class PanierController extends Controller
{
    /**
     * @Route("/add-panier/{id}", name="add_panier")
     */
    public function ajouterAction(Agenda $agenda)
    {

        $session = new Session();

        //  $session = $request->getSession();
        $panier = $session->get('panier');

        if (!is_array($panier)) {
            $panier = [];
        }
        if (!array_key_exists($agenda->getId(), $panier)) {
            $panier[$agenda->getId()] = 1;
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
            $session->set('panier', array());
        }
        $panier = "";
        $totalfinal = 0;
        foreach ($session->get('panier') as $id => $val) {
            $agenda = $em->getRepository('AdminBundle:Agenda')->find($id);
            $qte = $val['quantity'] + 1;
            $panier[] = array('agenda' => $agenda, 'quantite' => $qte, 'totalitem' => $agenda->getFormation()->getPrix() * $qte);
            $totalfinal += $agenda->getFormation()->getPrix() * $qte;

        }
//        foreach ($session->get('panier') as $id => $qte) {
//            $forAddUsers = new User();
//            $form = $this->createForm('AdminBundle\Form\AddUserType', $forAddUsers);
//            $form->handleRequest($request);
//            var_dump($form->getData()->getNom());
//            $userManager = $this->container->get('fos_user.user_manager');
//           // var_dump($userManager);
//
//         //   var_dump($user);
//
//            if ($form->isSubmitted() && $form->isValid()) {
//                $em = $this->getDoctrine()->getManager();
//                $user = $userManager->createUser();
//
////                $em->persist($forAddUsers);
////                $em->flush();
//                return $this->redirectToRoute('panier', array('id' => $forAddUsers->getId()));
//            }
//        }
//        $forAddUsers='';
        return $this->render('@Commerce/Default/panier.html.twig', array(
            'panier' => $panier, 'totalfinal' => $totalfinal,
//          'forAddUsers' => $forAddUsers,
//          'form' => $form->createView(),
// 'qte' => $qte,
        ));
    }

    /**
     * @Route("/quantityForm/{id}", name="qtform")
     */
    public function quantityFormAction($id, Request $request)
    {
        $choices = range(1, 20);
        $session = $request->getSession();
        $panier = $session->get('panier');
        $order = new Order();
        $user[] = array();
        for ($i = 0; $i < $panier[$id]['quantity']; $i++) {
            $user[] = array();
        }

        $order->setInscrits($user);
        $form = $this->createFormBuilder($order)
            ->add('quantity', ChoiceType::class, array('label' => false, 'choices' => $choices, 'data' => $panier[$id]['quantity']))
            ->add('inscrits', CollectionType::class, array(
                'entry_type' => AddUserType::class,
                'allow_add' => true,
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $qte = $data->getQuantity();
            $users = $data->getInscrits();
            $panier[$id] = ['quantity' => $qte, 'users' => $users];
            //var_dump($panier[$id]);
            $session->set('panier', $panier);
            $session->set('panier', $panier);
            return $this->redirect($this->generateUrl('panier'));
        }
        return $this->render('@Commerce/Default/quantityForm.html.twig', array(
            'form' => $form->createView(),
            'id' => $id
        ));
    }

    /**
     * @Route("/finalSubscription", name="final_subscription")
     */
    public function finalSubscriptionAction()
    {

        $nom = 'to';
        $prenom = 'to';
        $email = 'ettdddde.d@gmail.com';

        //if ($userTest->isSubmitted() && $userTest->isValid()) {

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AdminBundle:User')->findAll();


        foreach ($users as $value) {
            $emails[]=$value->getEmail();
            $usernames[]=$value->getUserName();
        }
        if (in_array($email, $emails)) {
            $user = $em->getRepository('AdminBundle:User')->findOneByEmail($email);


            //Enregistrer la formation dans le compte user
        } else {
           // if ($value->getUserName() == $prenom . $nom) {
            $username = $prenom . $nom; //toto //toto2
            $nb=2;
            while(in_array($username, $usernames)) {
                $username = $prenom . $nom . $nb;
                $nb++;
            }
            // creation d'un new user
            // au final, récupérer le new user dans un $user
            // et l'enregistrer en base
            //$tokenGenerator = $this->container->get('fos_user.util.token_generator');
            $password= uniqid(1, false);
            $passwordcrypt = md5($password);
            //$password = substr($tokenGenerator->generateToken(), 0, 8); // 8 chars

            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setPassword($passwordcrypt);

            $userManager->updateUser($user);
        }



        $message = \Swift_Message::newInstance()
            ->setSubject('FFSS45 : Finaliser votre inscription')
            ->setFrom('sancho4582@gmail.com')
            ->setTo('sancho4582@gmail.com')
            ->setBody(
                $this->renderView(
                    'emailSubscription.html.twig',
                    array('nom' => $nom,
                        'prenom' => $prenom,
                        'email' => $email,)
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);

        return $this->redirect($this->generateUrl('succes'));
        // }
        // return $this->render('@Front/Default/acceuil.html.twig', array(
        //   'form' => $form->createView(),
        //));


    }


    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function deleteFunction($id, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        unset($panier[$id]);
        $session->set('panier', $panier);
        return $this->redirect($this->generateUrl('panier'));
    }

}