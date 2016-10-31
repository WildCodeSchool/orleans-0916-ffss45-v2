<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Entity\Formation;
use AdminBundle\Entity\Agenda;
use AdminBundle\Form\FormationType;
use AdminBundle\Form\AgendaType;

/**
 * Formation controller.
 *
 * @Route("/admin/formation")
 */
class FormationController extends Controller
{
    /**
     * Lists all Formation entities.
     *
     * @Route("/", name="formation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formations = $em->getRepository('AdminBundle:Formation')->findAll();

        return $this->render('formation/index.html.twig', array(
            'formations' => $formations,
        ));
    }

    /**
     * Lists all Formation entities.
     *
     * @Route("/agendas/{id}", name="formation_agendas")
     */
    public function agendasAction(Formation $formation, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //recupération des agendas en cours pour une formation
        $agendas = $em->getRepository('AdminBundle:Agenda')->findByFormation($formation);

        // form pour ajouter un nouvel agenda à la formation sélectionnée
        $agenda = new Agenda();
        $agenda->setPhoto(
            new File($this->getParameter('brochures_directory').'/'.$agenda->getPhoto())
            );
        $form = $this->createForm(AgendaType::class, $agenda);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $agenda->getPhoto();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('upload_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $agenda->setPhoto($fileName);


            $agenda->setFormation($formation);
            $em->persist($agenda);
            $em->flush();

            return $this->redirectToRoute('formation_agendas', array('id' => $formation->getId()));
        }


        return $this->render('AdminBundle:Default:agenda.html.twig', array(
            'formation' => $formation,
            'agendas' => $agendas,
             'form' => $form->createView(),
       ));
    }

    /**
     * Creates a new Formation entity.
     *
     * @Route("/new", name="formation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formation = new Formation();
        $form = $this->createForm('AdminBundle\Form\FormationType', $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute('formation_show', array('id' => $formation->getId()));
        }

        return $this->render('formation/new.html.twig', array(
            'formation' => $formation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Formation entity.
     *
     * @Route("/{id}", name="formation_show")
     * @Method("GET")
     */
    public function showAction(Formation $formation)
    {
        $deleteForm = $this->createDeleteForm($formation);

        return $this->render('formation/show.html.twig', array(
            'formation' => $formation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Formation entity.
     *
     * @Route("/{id}/edit", name="formation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Formation $formation)
    {
        $deleteForm = $this->createDeleteForm($formation);
        $editForm = $this->createForm('AdminBundle\Form\FormationType', $formation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute('formation_edit', array('id' => $formation->getId()));
        }

        return $this->render('formation/edit.html.twig', array(
            'formation' => $formation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Formation entity.
     *
     * @Route("/{id}", name="formation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Formation $formation)
    {
        $form = $this->createDeleteForm($formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formation);
            $em->flush();
        }

        return $this->redirectToRoute('formation_index');
    }

    /**
     * Creates a form to delete a Formation entity.
     *
     * @param Formation $formation The Formation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Formation $formation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formation_delete', array('id' => $formation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * @Route("/formation/{id}/", name="formation_type")
     */
    public function showAgendaAction()
    {
        $agendas = $this->getDoctrine()
            ->getRepository('AdminBundle:Agenda')
            ->findAll();


        return $this->render('FrontBundle:Formation:formation.html.twig', array('formation'=>$agendas));
    }
}
