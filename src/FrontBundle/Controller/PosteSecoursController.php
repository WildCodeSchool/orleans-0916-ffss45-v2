<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 22/10/16
 * Time: 23:04
 */

namespace FrontBundle\Controller;

use FrontBundle\Entity\FormulaireSecours;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontBundle\Form\CreatePosteSecoursFlow;

class PosteSecoursController extends Controller
{

    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function createPosteSecoursAction()
    {
        $usersLog = $this->get('security.token_storage')->getToken()->getUser();

        if ($usersLog === 'anon.') {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $formData = new FormulaireSecours(); // Your form data class. Has to be an object, won't work properly with an array.

        $flow = $this->get('form.flow.createPosteSecours'); // must match the flow's service id
        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();
        $form->getData()->setUser($this->get('security.token_storage')->getToken()->getUser());
        $form->getData()->setStatut(0);

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em = $this->getDoctrine()->getManager();
                $em->persist($formData);
                $em->flush();
                
                $flow->reset(); // remove step data from the session
                $message = \Swift_Message::newInstance()
                    ->setSubject('Vous avez une nouvelle demande de Poste de Secours')
                    ->setFrom('site@secourisme45.com')
                    ->setTo('site@secourisme45.com')
                    ->setBody(
                        $this->renderView(
                            '@Front/PosteSecours/eMailPosteSecours.html.twig', ['id' => $formData->getId()]
                        ),
                        'text/html'
                    )/*
                     * If you also want to include a plaintext version of the message
                    ->addPart(
                        $this->renderView(
                            'Emails/registration.txt.twig',
                            array('name' => $name)
                        ),
                        'text/plain'
                    )
                    */
                ;
                $this->get('mailer')->send($message);

                return $this->redirect($this->generateUrl('succes')); // redirect when done
            }
        }

        return $this->render('FrontBundle:PosteSecours:createPosteSecours.html.twig', array(
            'form' => $form->createView(),
            'flow' => $flow,
        ));
    }


    /**
     * @Route("/formulaire-edit/{id}", name="formulaire_edit")
     */
    public function editPosteSecoursAction(FormulaireSecours $fs)
    {
        $usersLog = $this->get('security.token_storage')->getToken()->getUser();

        if ($usersLog === 'anon.') {
            return $this->redirectToRoute('fos_user_security_login');
        }

        // $formData = new FormulaireSecours(); // Your form data class. Has to be an object, won't work properly with an array.
        $formData = $fs; // Your form data class. Has to be an object, won't work properly with an array.

        $flow = $this->get('form.flow.createPosteSecours'); // must match the flow's service id
        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();
        //$form->getData()->setUser($this->get('security.token_storage')->getToken()->getUser());
        $form->getData()->setStatut(0);

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em = $this->getDoctrine()->getManager();
                $em->persist($formData);
                $em->flush();
                $flow->reset(); // remove step data from the session

                $message = \Swift_Message::newInstance()
                    ->setSubject('Vous avez une nouvelle demande de Poste de Secours')
                    ->setFrom('site@secourisme45.com')
                    ->setTo('site@secourisme45.com')
                    ->setBody(
                        $this->renderView(
                            '@Front/PosteSecours/eMailPosteSecours.html.twig', ['id' => $form->getData()->getId()]
                        ),
                        'text/html'
                    )
                ;
                $this->get('mailer')->send($message);

                return $this->redirect($this->generateUrl('succes')); // redirect when done
            }
        }

        return $this->render('FrontBundle:PosteSecours:createPosteSecours.html.twig', array(
            'form' => $form->createView(),
            'flow' => $flow,
        ));
    }

    /**
     * @Route("/formulaire-pdf/{id}", name="formulaire_pdf")
     */
    public function formulairePDFAction(FormulaireSecours $formulaireSecours)
    {
        $html = $this->renderView('FrontBundle:PosteSecours:formSecours.html.twig', [
                'formulaireSecour' => $formulaireSecours,
            ]
        );
        if ($formulaireSecours->getUser() === $this->getUser()) {
            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'        => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="' . 'posteSecours' . uniqid() . 'pdf"',
                )
            );
        } else {
            throw  new \Exception('Vous n\'avez pas le droit d\'accéder à cette ressource');
        }
    }


}