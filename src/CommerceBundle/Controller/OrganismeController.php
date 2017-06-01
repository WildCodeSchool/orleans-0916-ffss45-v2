<?php

namespace CommerceBundle\Controller;

use CommerceBundle\Entity\Organisme;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
/**
 * Organisme controller.
 *
 * @Route("organisme")
 * @security("has_role('ROLE_ADMIN')")
 */
class OrganismeController extends Controller
{
    /**
     * Lists all organisme entities.
     *
     * @Route("/", name="organisme_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $organismes = $em->getRepository('CommerceBundle:Organisme')->findAll();

        return $this->render('organisme/index.html.twig', array(
            'organismes' => $organismes,
        ));
    }

    /**
     * Creates a new organisme entity.
     *
     * @Route("/new", name="organisme_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $organisme = new Organisme();
        $form = $this->createForm('CommerceBundle\Form\OrganismeType', $organisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organisme);
            $em->flush($organisme);

            return $this->redirectToRoute('organisme_show', array('id' => $organisme->getId()));
        }

        return $this->render('organisme/new.html.twig', array(
            'organisme' => $organisme,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a organisme entity.
     *
     * @Route("/{id}", name="organisme_show")
     * @Method("GET")
     */
    public function showAction(Organisme $organisme)
    {
        $deleteForm = $this->createDeleteForm($organisme);

        return $this->render('organisme/show.html.twig', array(
            'organisme' => $organisme,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing organisme entity.
     *
     * @Route("/{id}/edit", name="organisme_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Organisme $organisme)
    {
        $deleteForm = $this->createDeleteForm($organisme);
        $editForm = $this->createForm('CommerceBundle\Form\OrganismeType', $organisme);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('organisme_edit', array('id' => $organisme->getId()));
        }

        return $this->render('organisme/edit.html.twig', array(
            'organisme' => $organisme,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a organisme entity.
     *
     * @Route("/{id}", name="organisme_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Organisme $organisme)
    {
        $form = $this->createDeleteForm($organisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($organisme);
            $em->flush($organisme);
        }

        return $this->redirectToRoute('organisme_index');
    }

    /**
     * Creates a form to delete a organisme entity.
     *
     * @param Organisme $organisme The organisme entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Organisme $organisme)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organisme_delete', array('id' => $organisme->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
