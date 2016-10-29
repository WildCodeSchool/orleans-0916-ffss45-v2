<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 22/10/16
 * Time: 23:04
 */

namespace FrontBundle\Controller;

use FrontBundle\Entity\FormulaireSecours;
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
        $formData = new FormulaireSecours(); // Your form data class. Has to be an object, won't work properly with an array.

        $flow = $this->get('form.flow.createPosteSecours'); // must match the flow's service id
        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em = $this->getDoctrine()->getManager();
                $em->persist($formData);


                $message = \Swift_Message::newInstance()
                    ->setSubject('Vous avez une nouvelle demande de Poste de Secours')
                    ->setFrom('houssemaine.j@gmail.com')
                    ->setTo('asakura45@gmail.com')
                    ->setBody(
                        $this->renderView(

                            '@Front/PosteSecours/eMailPosteSecours.html.twig'

                        ),
                        'text/html'
                    )
                    /*
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
                $em->flush();
                $flow->reset(); // remove step data from the session

                return $this->redirect($this->generateUrl('succes')); // redirect when done
            }
        }

        return $this->render('FrontBundle:PosteSecours:createPosteSecours.html.twig', array(
            'form' => $form->createView(),
            'flow' => $flow,
        ));
    }
}