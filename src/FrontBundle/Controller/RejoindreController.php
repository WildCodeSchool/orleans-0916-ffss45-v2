<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 31/10/16
 * Time: 14:07
 */

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FrontBundle\Entity\Rejoindre;

class RejoindreController extends Controller
{

    /**
     * @Route("/rejoindre", name="page_rejoindre")
     */
    public function rejoindreAction(Request $request)
    {
        $rejoindre = new Rejoindre();

        $form = $this->createFormBuilder($rejoindre)
            ->add('civilite', ChoiceType::class, array('choices'=>array('Madame'=>'Madame', 'Monsieur'=>'Monsieur'),'choices_as_values' => true, 'label'=>'Civilité '))
            ->add('nom', TextType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre nom')
            ))
            ->add('prenom', TextType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre prénom')
            ))
            ->add('adresse', TextType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre adresse')
            ))
            ->add('ville', TextType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre ville')
            ))
            ->add('codePostal', NumberType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre code postal')
            ))
            ->add('telephone', NumberType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre téléphone')
            ))
            ->add('email', EmailType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre email')
            ))
            ->add('sujet', TextType::class, array('label'=>false,'attr'=>array('placeholder'=>'Sujet du message')
            ))
            ->add('message', TextareaType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre demande')
            ))
            ->add('dateNaissance', BirthdayType::class, array('label'=>'Date de Naissance')
            )
            ->add('ffss', TextareaType::class, array('label'=>false,'attr'=>array('placeholder'=>'Comment avez-vous connu la FFSS ?')
            ))
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $rejoindre = $form->getData();

            $message = \Swift_Message::newInstance()
                ->setSubject('Vous avez une nouvelle demande pour rejoindre la FFSS')
                ->setFrom('site@secourisme45.com')
                ->setTo('site@secourisme45.com')
                ->setBody(
                    $this->renderView(
                        'rejoindreEmail.html.twig',
                        array('rejoindre'=>$rejoindre)

                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('succes'));
        }
        return $this->render('@Front/Default/rejoindre.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}