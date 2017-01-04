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


class PanierController extends Controller
{
    /**
     * @Route("/add-panier/{id}", name="add_panier")
     */
    public function ajouterAction(Agenda $agenda)
    {

        $session = new Session();

      //  $session = $request->getSession();
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
        foreach ($session->get('panier') as $id => $val) {
            $agenda = $em->getRepository('AdminBundle:Agenda')->find($id);
            $qte = $val['quantity']+1;
            $panier[] = array('agenda' => $agenda, 'quantite' => $qte, 'totalitem' => $agenda->getFormation()->getPrix()*$qte);
            $totalfinal+=$agenda->getFormation()->getPrix()*$qte;

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
            'panier' => $panier,  'totalfinal' => $totalfinal,
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
        $choices = range(1,20);
        $session = $request->getSession();
        $panier = $session->get('panier');
        $order = new Order();
        $user[]=array();
        for ($i=0; $i<$panier[$id]['quantity'];$i++) {
            $user[]=array();
        }

        $order->setInscrits($user);
        $form = $this->createFormBuilder($order)
             ->add('quantity', ChoiceType::class, array('label'=>false, 'choices' => $choices, 'data'=>$panier[$id]['quantity']))
             ->add('inscrits', CollectionType::class, array(
                   'entry_type'   => AddUserType::class,
                   'allow_add'=>true,
             ))
            ->getForm()
        ;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $qte=$data->getQuantity();
            $users=$data->getInscrits();
            $panier[$id]=['quantity'=>$qte, 'users'=>$users];
            //var_dump($panier[$id]);
            $session->set('panier',$panier);
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