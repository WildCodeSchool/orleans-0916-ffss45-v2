<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Entity\Agenda;
use AdminBundle\Form\AgendaType;

/**
 * Agenda controller.
 *
 * @Route("/agenda")
 */
class AgendaController extends Controller
{
    /**
     * Lists all Agenda entities.
     *
     * @Route("/", name="agenda_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agendas = $em->getRepository('AdminBundle:Agenda')->findAll();

        return $this->render('agenda/index.html.twig', array(
            'agendas' => $agendas,
        ));
    }

    /**
     * Creates a new Agenda entity.
     *
     * @Route("/new", name="agenda_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $agenda = new Agenda();
        $form = $this->createForm('AdminBundle\Form\AgendaType', $agenda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agenda);
            $em->flush();

            return $this->redirectToRoute('agenda_show', array('id' => $agenda->getId()));
        }

        return $this->render('agenda/new.html.twig', array(
            'agenda' => $agenda,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Agenda entity.
     *
     * @Route("/{id}", name="agenda_show")
     * @Method("GET")
     */
    public function showAction(Agenda $agenda)
    {
        $deleteForm = $this->createDeleteForm($agenda);

        return $this->render('agenda/show.html.twig', array(
            'agenda' => $agenda,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Agenda entity.
     *
     * @Route("/{id}/edit", name="agenda_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Agenda $agenda)
    {
        $em = $this->getDoctrine()->getManager();

        //recupération des agendas en cours pour une formation
        $formation = $agenda->getFormation();
        $agendas = $em->getRepository('AdminBundle:Agenda')->findByFormation($formation);

        $deleteForm = $this->createDeleteForm($agenda);
        $editForm = $this->createForm('AdminBundle\Form\AgendaType', $agenda);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($agenda);
            $em->flush();

            return $this->redirectToRoute('agenda_edit', array('id' => $agenda->getId()));
        }

        return $this->render('agenda/edit.html.twig', array(
            'agenda' => $agenda,
            'agendas' => $agendas,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Agenda entity.
     *
     * @Route("/{id}", name="agenda_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Agenda $agenda)
    {
        $form = $this->createDeleteForm($agenda);
        $form->handleRequest($request);
        $formation = $agenda->getFormation();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agenda);
            $em->flush();
        }

        return $this->redirectToRoute('formation_agendas', array('formation', $formation->getId()));
    }

    /**
     * Creates a form to delete a Agenda entity.
     *
     * @param Agenda $agenda The Agenda entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agenda $agenda)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agenda_delete', array('id' => $agenda->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

	/**
	 * Displays a form to edit an existing Agenda entity.
	 *
	 * @Route("/{id}/inscription", name="agenda_inscription")
	 * @Method({"GET", "POST"})
	 */
	public function inscriptionAction(Agenda $agenda)
	{
		$em = $this->getDoctrine()->getManager();

		//recupération des agendas en cours pour une formation

		$reservations = $em->getRepository('CommerceBundle:Reservation')->findByAgenda($agenda);



		return $this->render('agenda/inscription.html.twig', array(
			'reservations' => $reservations,

		));
	}


}