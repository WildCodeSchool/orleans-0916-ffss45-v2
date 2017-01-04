<?php

namespace FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FrontBundle\Entity\FormulaireSecours;
use FrontBundle\Form\FormulaireSecoursType;

/**
 * FormulaireSecours controller.
 *
 * @Route("/formulairesecours")
 */
class FormulaireSecoursController extends Controller
{
    /**
     * Lists all FormulaireSecours entities.
     *
     * @Route("/", name="formulairesecours_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formulaireSecours = $em->getRepository('FrontBundle:FormulaireSecours')->findAll();

        return $this->render('formulairesecours/index.html.twig', array(
            'formulaireSecours' => $formulaireSecours,
        ));
    }

    /**
     * Creates a new FormulaireSecours entity.
     *
     * @Route("/new", name="formulairesecours_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formulaireSecour = new FormulaireSecours();
        $form = $this->createForm('FrontBundle\Form\FormulaireSecoursType', $formulaireSecour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formulaireSecour);
            $em->flush();

            return $this->redirectToRoute('formulairesecours_show', array('id' => $formulaireSecour->getId()));
        }

        return $this->render('formulairesecours/new.html.twig', array(
            'formulaireSecour' => $formulaireSecour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FormulaireSecours entity.
     *
     * @Route("/{id}", name="formulairesecours_show")
     * @Method("GET")
     */
    public function showAction(FormulaireSecours $formulaireSecour)
    {
        $deleteForm = $this->createDeleteForm($formulaireSecour);

        return $this->render('formulairesecours/show.html.twig', array(
            'formulaireSecour' => $formulaireSecour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FormulaireSecours entity.
     *
     * @Route("/{id}/edit", name="formulairesecours_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FormulaireSecours $formulaireSecour)
    {
        $deleteForm = $this->createDeleteForm($formulaireSecour);
        $editForm = $this->createForm('FrontBundle\Form\FormulaireSecoursType', $formulaireSecour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formulaireSecour);
            $em->flush();

            return $this->redirectToRoute('formulairesecours_edit', array('id' => $formulaireSecour->getId()));
        }

        return $this->render('formulairesecours/edit.html.twig', array(
            'formulaireSecour' => $formulaireSecour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a FormulaireSecours entity.
     *
     * @Route("/{id}", name="formulairesecours_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FormulaireSecours $formulaireSecour)
    {
        $form = $this->createDeleteForm($formulaireSecour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formulaireSecour);
            $em->flush();
        }

        return $this->redirectToRoute('formulairesecours_index');
    }

    /**
     * Creates a form to delete a FormulaireSecours entity.
     *
     * @param FormulaireSecours $formulaireSecour The FormulaireSecours entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FormulaireSecours $formulaireSecour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formulairesecours_delete', array('id' => $formulaireSecour->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
