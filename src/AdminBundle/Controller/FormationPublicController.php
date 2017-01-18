<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\FormationPublic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Formationpublic controller.
 *
 * @Route("/formationpublic")
 */
class FormationPublicController extends Controller
{
    /**
     * Lists all formationPublic entities.
     *
     * @Route("/", name="formationpublic_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formationPublics = $em->getRepository('AdminBundle:FormationPublic')->findAll();

        return $this->render('formationpublic/index.html.twig', array(
            'formationPublics' => $formationPublics,
        ));
    }

    /**
     * Creates a new formationPublic entity.
     *
     * @Route("/new", name="formationpublic_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formationPublic = new Formationpublic();
        $form = $this->createForm('AdminBundle\Form\FormationPublicType', $formationPublic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formationPublic);
            $em->flush($formationPublic);

            return $this->redirectToRoute('formationpublic_show', array('id' => $formationPublic->getId()));
        }

        return $this->render('formationpublic/new.html.twig', array(
            'formationPublic' => $formationPublic,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a formationPublic entity.
     *
     * @Route("/{id}", name="formationpublic_show")
     * @Method("GET")
     */
    public function showAction(FormationPublic $formationPublic)
    {
        $deleteForm = $this->createDeleteForm($formationPublic);

        return $this->render('formationpublic/show.html.twig', array(
            'formationPublic' => $formationPublic,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing formationPublic entity.
     *
     * @Route("/{id}/edit", name="formationpublic_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FormationPublic $formationPublic)
    {
        $deleteForm = $this->createDeleteForm($formationPublic);
        $editForm = $this->createForm('AdminBundle\Form\FormationPublicType', $formationPublic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formationpublic_edit', array('id' => $formationPublic->getId()));
        }

        return $this->render('formationpublic/edit.html.twig', array(
            'formationPublic' => $formationPublic,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a formationPublic entity.
     *
     * @Route("/{id}", name="formationpublic_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FormationPublic $formationPublic)
    {
        $form = $this->createDeleteForm($formationPublic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formationPublic);
            $em->flush($formationPublic);
        }

        return $this->redirectToRoute('formationpublic_index');
    }

    /**
     * Creates a form to delete a formationPublic entity.
     *
     * @param FormationPublic $formationPublic The formationPublic entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FormationPublic $formationPublic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formationpublic_delete', array('id' => $formationPublic->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
