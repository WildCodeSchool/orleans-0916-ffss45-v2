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
        $totalfinal = 0;
        foreach ($session->get('panier') as $id => $val) {
            $agenda = $em->getRepository('AdminBundle:Agenda')->find($id);
            $qte = $val['quantity']+1;
            $panier[] = array('agenda' => $agenda, 'quantite' => $qte, 'totalitem' => $agenda->getFormation()->getPrix()*$qte);
            $totalfinal+=$agenda->getFormation()->getPrix()*$qte;
        }

        return $this->render('@Commerce/Default/panier.html.twig', array(
            'panier' => $panier,  'totalfinal' => $totalfinal,
//            'forAddUsers' => $forAddUsers,
//            'form' => $form->createView(),
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
        //var_dump($panier);
        $order = new Order();
        $user[] = array();
            for ($i = 0; $i < $panier[$id]['quantity']; $i++) {
                $user[] = array();

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
            $nextAction = $form->get('saveAndAdd')->isClicked()
                ? 'task_new'
                : 'task_success';
            $toto = new User();
//            var_dump($toto);
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $qte=$data->getQuantity()+1;

            var_dump($data);
          //  var_dump($form->getData()->getInscrits());
            $inscrits=$form->getData()->getInscrits();

                $nom = $inscrits[0]['nom'];
                $prenom = $inscrits[0]['prenom'];
                $email = $inscrits[0]['email'];

            $toto->setNom($nom);
            $toto->setPrenom($prenom);
            $toto->setUsername($nom.'_'.$prenom);
            $toto->setEmail($email);
      //      $toto=$data->getInscrits();
            var_dump($toto);
            $panier[$id]=['quantity'=>$qte, 'users'=>$toto];
         //   var_dump($panier[$id]);
            $session->set('panier',$panier);
            $em->persist($toto);
            $em->flush($toto);
          //  return $this->redirect($this->generateUrl('panier'));
            return $this->redirectToRoute($nextAction);
        }
         return $this->render('@Commerce/Default/quantityForm.html.twig', array(
        'form' => $form->createView(),
        'id'=>$id,
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