<?php

namespace CommerceBundle\Controller;

use CommerceBundle\Entity\upload;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Upload controller.
 *
 * @Route("upload")
 */
class uploadController extends Controller
{
    /**
     * Lists all upload entities.
     *
     * @Route("/", name="upload_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $uploads = $em->getRepository('CommerceBundle:upload')->findAll();

        return $this->render('upload/index.html.twig', array(
            'uploads' => $uploads,
        ));
    }

    /**
     * Creates a new upload entity.
     *
     * @Route("/new", name="upload_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $upload = new Upload();
        $form = $this->createForm('CommerceBundle\Form\uploadType', $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($upload);
            $em->flush($upload);

            return $this->redirectToRoute('upload_show', array('id' => $upload->getId()));
        }

        return $this->render('upload/new.html.twig', array(
            'upload' => $upload,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a upload entity.
     *
     * @Route("/{id}", name="upload_show")
     * @Method("GET")
     */
    public function showAction(upload $upload)
    {
        $deleteForm = $this->createDeleteForm($upload);

        return $this->render('upload/show.html.twig', array(
            'upload' => $upload,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing upload entity.
     *
     * @Route("/{id}/edit", name="upload_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, upload $upload)
    {
        $deleteForm = $this->createDeleteForm($upload);
        $editForm = $this->createForm('CommerceBundle\Form\uploadType', $upload);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('upload_edit', array('id' => $upload->getId()));
        }

        return $this->render('upload/edit.html.twig', array(
            'upload' => $upload,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a upload entity.
     *
     * @Route("/{id}", name="upload_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, upload $upload)
    {
        $form = $this->createDeleteForm($upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($upload);
            $em->flush($upload);
        }

        return $this->redirectToRoute('upload_index');
    }

    /**
     * Creates a form to delete a upload entity.
     *
     * @param upload $upload The upload entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(upload $upload)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('upload_delete', array('id' => $upload->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
