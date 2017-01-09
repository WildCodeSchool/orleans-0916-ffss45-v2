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
                $panier[$agenda->getId()] = ['agenda' => $agenda, 'formation' => $agenda->getFormation()->getNomLong(), 'quantity' => 1, 'inscrits'=>null];
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
        $panier = $session->get('panier');
        //dump($panier);
        $totalfinal = 0;

        if (is_array($panier)) {
            foreach ($session->get('panier') as $id => $article) {
                $agenda = $em->getRepository('AdminBundle:Agenda')->find($id);

                $panier[$agenda->getId()]['totalitem'] = $agenda->getFormation()->getPrix() * $article['quantity'];
                $totalfinal += $panier[$agenda->getId()]['totalitem'];
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
                $panier[$id]['inscrits'][$key] = [
                    'nom'    => $data['nom'],
                    'prenom' => $data['prenom'],
                    'email'  => $data['email'],
                ];
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
     * @Route("/valid-cart", name="valid_cart")
     */
    public function validateCartAction(Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        dump($panier);
        return $this->render('@Commerce/Default/validCart.html.twig', array(
            'panier' => $panier,
        ));

    }

    /**
     * @Route("/payment", name="payment")
     */
    public function paymentAction(Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $errorBack = 0;
        if ($panier) {
            foreach ($panier as $article) {
                for ($i = 0; $i < $article['quantity']; $i++) {
                    if (!array_key_exists($i, $article['inscrits'])) {
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

}