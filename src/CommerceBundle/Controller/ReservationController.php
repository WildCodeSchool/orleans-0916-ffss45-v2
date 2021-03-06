<?php

namespace CommerceBundle\Controller;

use CommerceBundle\CommerceBundle;
use CommerceBundle\Entity\Reservation;
use AdminBundle\Entity\User;
use AdminBundle\Entity\Agenda;
use CommerceBundle\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Reservation controller.
 *
 * @Route("reservation")
 */
class ReservationController extends Controller
{
    /**
     * Lists all reservation entities.
     *
     * @Route("/", name="reservation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservation = $em->getRepository('CommerceBundle:Reservation')->findAll();
        return $this->render('reservation/index.html.twig', array(
            'reservation' => $reservation,
        ));
    }

	/**
	 * @Route("/presence_pdf/{id}/pdf", name="presence_pdf")
	 *
	 */
	public function presence_pdfAction(Agenda $agenda )
	{
		$html = $this->renderView('CommerceBundle:Default:presence_pdf.html.twig', array(
			'agenda'  => $agenda
		));


		return new Response(
			$this->get('knp_snappy.pdf')->getOutputFromHtml($html, array('orientation'=>'Landscape')),
			200,
			array(
				'Content-Type'          => 'application/pdf',
				'Content-Disposition'   => 'attachment; filename="feuille_emargement.pdf"'
			)
		);
	}



	/**
	 * @Route("/convocation_pdf/{id}/pdf", name="convocation_pdf")
	 *
	 */
	public function convocation_pdfAction(Agenda $agenda )
	{
		$html = $this->renderView('AdminBundle:Default:convocation.html.twig', array(
			'agenda'  => $agenda
		));


		return new Response(
			$this->get('knp_snappy.pdf')->getOutputFromHtml($html),
			200,
			array(
				'Content-Type'          => 'application/pdf',
				'Content-Disposition'   => 'attachment; filename="convocation.pdf"'
			)
		);
	}

	/**
	 * @Route("/attestation_presence_pdf/{id}/pdf", name="attestation_presence_pdf")
	 *
	 */
	public function attestation_presence_pdfAction(Reservation $reservation)
	{
		$html = $this->renderView('AdminBundle:Default:attestation_presence_pdf.html.twig', array(
			'reservation'  => $reservation,
		));

		return new Response(
			$this->get('knp_snappy.pdf')->getOutputFromHtml($html),
			200,
			array(
				'Content-Type'          => 'application/pdf',
				'Content-Disposition'   => 'attachment; filename="attestation_presence.pdf"'
			)
		);
	}

	/**
	 * @Route("/attestation_presence_pdf_all/{id}/pdf", name="attestation_presence_pdf_all")
	 *
	 */
	public function attestationPresencePdfAllAction(Agenda $agenda)
	{
	    $html='';
        foreach ($agenda->getReservations() as $reservation) {
            $html .= $this->renderView('AdminBundle:Default:attestation_presence_pdf.html.twig', array(
                'reservation' => $reservation,
            ));
        }
		return new Response(
			$this->get('knp_snappy.pdf')->getOutputFromHtml($html),
			200,
			array(
				'Content-Type'          => 'application/pdf',
				'Content-Disposition'   => 'attachment; filename="attestation_presence_all.pdf"'
			)
		);
	}

	/**
	 *
	 * @Route("/resa_profil", name="reservation_profil")
	 * @Method("GET")
	 */
	public function reservationProfilAction()
	{
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$reservations = $em->getRepository('CommerceBundle:Reservation')->findByUser($user);
		return $this->render('CommerceBundle:Default:index.html.twig', array(
			'reservations' => $reservations,
		));
	}

	/**
	 *
	 * @Route("/resa_poste", name="reservation_poste")
	 * @Method("GET")
	 */
	public function reservationPosteAction()
	{
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$formulaireSecours = $em->getRepository('FrontBundle:FormulaireSecours')->findByUser($user);
		return $this->render('CommerceBundle:Default:poste.html.twig', array(
			'formulaireSecours' => $formulaireSecours,
		));
	}


	/**
	 * Lists all reservation entities.
	 *
	 * @Route("/agenda/{id}", name="reservation_agenda_index")
	 * @Method("GET")
     * @security("has_role('ROLE_ADMIN')")
	 */
	public function resaAgendaAction(Agenda $agenda)
	{
		$em = $this->getDoctrine()->getManager();
		$reservation = $em->getRepository('CommerceBundle:Reservation')->findAll();
		return $this->render('reservation/index.html.twig', array(
			'agenda' => $agenda,
		));
	}

    /**
     * Creates a new reservation entity.
     *
     * @Route("/new/{id}", name="reservation_new")
     * @Method({"GET", "POST"})
     * @security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Agenda $agenda, Request $request)
    {
        $reservation = new Reservation();
        $form = $this->createForm('CommerceBundle\Form\ReservationType', $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $reservation->setAgenda($agenda);
            $em->persist($reservation);
            $em->flush($reservation);

            return $this->redirectToRoute('reservation_show', array('id' => $reservation->getId()));
        }

        return $this->render('reservation/new.html.twig', array(
            'agenda' => $agenda,
	       'reservation' => $reservation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservation entity.
     *
     * @Route("/{id}", name="reservation_show")
     * @Method("GET")
     * @security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);
//        $webPath = $reservation->getWebPath();
//        $alt = $reservation->getAlt();
        return $this->render('reservation/show.html.twig', array(
            'reservation' => $reservation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservation entity.
     *
     * @Route("/{id}/edit", name="reservation_edit")
     * @security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);
        $editForm = $this->createForm('CommerceBundle\Form\ReservationType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_edit', array('id' => $reservation->getId()));
        }

        return $this->render('reservation/edit.html.twig', array(
            'reservation' => $reservation,
//            'webPath' => $webPath,
//            'alt' => $alt,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservation entity.
     *
     * @Route("/{id}", name="reservation_delete")
     * @Method("DELETE")
     * @security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Reservation $reservation)
    {
        $form = $this->createDeleteForm($reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush($reservation);
        }

        return $this->redirectToRoute('reservation_index');
    }

    /**
     * Creates a form to delete a reservation entity.
     *
     * @param Reservation $reservation The reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservation $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation_delete', array('id' => $reservation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }





}
