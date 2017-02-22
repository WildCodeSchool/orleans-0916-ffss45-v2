<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use AdminBundle\Entity\Formation;
use ActualiteBundle\Entity\Actualite;
use FrontBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="page_accueil_principale")
     */
    public function contactAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createFormBuilder($contact)
            ->add('nom', TextType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre nom')
                ))
            ->add('prenom', TextType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre prénom')
            ))
            ->add('email', EmailType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre email')
            ))
            ->add('message', TextareaType::class, array('label'=>false,'attr'=>array('placeholder'=>'Votre demande')
            ))
            ->add('anti-robot', CaptchaType::class, array('label'=>false,'attr'=>array('placeholder'=>'Merci de recopier les caractères')))
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();

            $message = \Swift_Message::newInstance()
                ->setSubject('Vous avez une nouvelle demande de contact')
                ->setFrom('site@secourisme45.com')
                ->setTo('site@secourisme45.com')
                ->setBody(
                    $this->renderView(
                        'emailContact.html.twig',
                        array('contact'=>$contact)

                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('succes'));
        }
        return $this->render('@Front/Default/acceuil.html.twig', array(
            'form' => $form->createView(),
        ));
    }



    /**
     * @Route("/actualites", name="page_actualites")
     *
     */

    public function actusFrontAction()
    {
        $actualites = $this->getDoctrine()
            ->getRepository('ActualiteBundle:Actualite')
            ->findAll();

        return $this->render('@Front/Default/pageActus.html.twig', array('actualites' => $actualites));
    }

    /**
     * @Route("/formation/{nomCourt}", name="formation")
     */
    public function showAction(Formation $formation)
    {
        return $this->render('FrontBundle:Default:formation.html.twig', array('formation' => $formation));

    }
    
    /**
     * @Route("/formation/{id}/pdf", name="formation_pdf")
     */
    public function formationPDFAction(Formation $formation)
    {
		$html = $this->renderView('FrontBundle:Default:formation_content.html.twig', array(
			'formation'  => $formation
		));		
		//$pageUrl = $this->generateUrl('formation', array('nomCourt'=>$formation->getNomCourt()), true); // use absolute path!

		return new Response(
			$this->get('knp_snappy.pdf')->getOutputFromHtml($html),
			200,
			array(
				'Content-Type'          => 'application/pdf',
				'Content-Disposition'   => 'attachment; filename="'.$formation->getNomCourt().'.pdf"'
			)
		);
	}

    /**
     * @Route("/mentions-legales", name="mentionsLegales")
     */
    public function mentionsLegalesAction()
    {
        return $this->render('@Front/Default/mentionsLegales.html.twig');


    }

    /**
     * @Route("/secours-civil", name="secoursCivil")
     */
    public function secoursCivilAction()
    {
        return $this->render('@Front/PosteSecours/secoursCivil.html.twig');
    }

	/**
	 * @Route("/inscription", name="inscription")
	 */
	public function inscriptionAction()
	{
		return $this->render('login.html.twig');


	}

	/**
	 * @Route("/register2", name="register2")
	 */
	public function register2Action()
	{
		return $this->render('CommerceBundle:Default:enregistrement.html.twig');
	}

	/**
	 * @Route("/compte", name="compte")
	 */
	public function compteAction()
	{
		return $this->render('CommerceBundle:Default:compte.html.twig');
	}

}

