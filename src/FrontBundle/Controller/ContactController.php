<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 29/10/16
 * Time: 20:50
 */

namespace FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontBundle\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactController extends Controller
{
    public function contactAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createFormBuilder($contact)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $contact = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Vous avez une nouvelle demande de contact')
                ->setFrom('houssemaine.j@gmail.com')
                ->setTo('asakura45@gmail.com')
                ->setBody(
                    $this->renderView(
                        'emailContact.html.twig',
                        array('contact'=>$contact)

                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('page_accueil_principale');
        }
        return $this->render('@Front/Default/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}