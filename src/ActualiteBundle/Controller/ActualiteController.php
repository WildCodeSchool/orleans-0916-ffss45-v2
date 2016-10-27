<?php

namespace ActualiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ActualiteBundle\Form\ActualiteType;
use Symfony\Component\HttpFoundation\Request;
use ActualiteBundle\Entity\Actualite;
class ActualiteController extends Controller
{

    /**
     * @Route("/actu/{id}/delete", name="delete_actu")
     * @ParamConverter("actuality", class="ActualiteBundle:Actualite")
     *
     */
    public function deleteAction(Actualite $actualite)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($actualite);
        $em->flush();
        return $this->redirectToRoute('actu');
    }
    /**
     * @Route("/actu", name="actu")
     */
    public function addAction( Request $request)
    {

        $form = $this->createForm(ActualiteType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $actualite = $form->getData();
            $file = $actualite->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory'),
                $fileName
            );
            $actualite->setImage($fileName);

            // ... perform some action, such as saving the task to the database
            //for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('actu');
        }

        return $this->render(':Actus:actus.html.twig', array('form'=>$form->createView(),
            )
        );
    }


    /**
     * @Route("/actu/list/", name="list_actuonly")
     */
    public function actuOnlyAction()
    {
        $actualites = $this->getDoctrine()
            ->getRepository('ActualiteBundle:Actualite')
            ->findAll();


        return $this->render(':Actus:actus.html.twig', array('actualites'=>$actualites));
    }

    public function findLastActuAction()
    {
        $actualites = $this->getDoctrine()
            ->getRepository('ActualiteBundle:Actualite')
            ->findBy(array(), array('id'=>'DESC'), 3);
        return $this->render('@Actualite/Default/lastActu.html.twig', array('actualites'=>$actualites));
    }


}

