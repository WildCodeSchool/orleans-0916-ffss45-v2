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
     * @Route("/actu/list", name="list_actu")
     */
    public function indexAction()
    {

        return $this->render('ActualiteBundle:Default:index.html.twig');
    }

    /**
     * @Route("/actu/{id}/delete", name="delete_actu")
     * @ParamConverter("actuality", class="ActualiteBundle:Actualite")
     *
     */
    public function deleteAction(Actualite $actuality)
    {

//        $actuality = $this->getDoctrine()
//            ->getRepository('ActualiteBundle:Actualite')
//            ->findOneById($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($actuality);
        $em->flush();
        return $this->redirectToRoute('list_actu');
    }
    /**
     * @Route("/actu/add", name="add_actu")
     */
    public function addAction( Request $request)
    {

        $form = $this->createForm(ActualiteType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $actuality = $form->getData();
            $file = $actuality->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory'),
                $fileName
            );
            $actuality->setImage($fileName);

            // ... perform some action, such as saving the task to the database
            //for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($actuality);
            $em->flush();

            return $this->redirectToRoute('list_actu');
        }

        return $this->render('@Actualite/Default/add.html.twig', array('form'=>$form->createView(),
            )
        );
    }


    /**
     * @Route("/actu/list/actuonly", name="list_actuonly")
     */
    public function actuOnlyAction()
    {
        $actualities = $this->getDoctrine()
            ->getRepository('ActualiteBundle:Actualite')
            ->findAll();


        return $this->render('@Actualite/Default/actuOnly.html.twig', array('actualities'=>$actualities));
    }
}

