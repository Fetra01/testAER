<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ResultStudent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Resultstudent controller.
 *
 * @Route("resultstudent")
 */
class ResultStudentController extends Controller
{
    /**
     * Lists all resultStudent entities.
     *
     * @Route("/", name="resultstudent_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $resultStudents = $em->getRepository('AppBundle:ResultStudent')->findAll();

        return $this->render('resultstudent/index.html.twig', array(
            'resultStudents' => $resultStudents,
        ));
    }

    /**
     * Creates a new resultStudent entity.
     *
     * @Route("/new", name="resultstudent_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $resultStudent = new Resultstudent();
        $form = $this->createForm('AppBundle\Form\ResultStudentType', $resultStudent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resultStudent);
            $em->flush();

            return $this->redirectToRoute('resultstudent_show', array('id' => $resultStudent->getId()));
        }

        return $this->render('resultstudent/new.html.twig', array(
            'resultStudent' => $resultStudent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a resultStudent entity.
     *
     * @Route("/{id}", name="resultstudent_show")
     * @Method("GET")
     */
    public function showAction(ResultStudent $resultStudent)
    {
        $deleteForm = $this->createDeleteForm($resultStudent);

        return $this->render('resultstudent/show.html.twig', array(
            'resultStudent' => $resultStudent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing resultStudent entity.
     *
     * @Route("/{id}/edit", name="resultstudent_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ResultStudent $resultStudent)
    {
        $deleteForm = $this->createDeleteForm($resultStudent);
        $editForm = $this->createForm('AppBundle\Form\ResultStudentType', $resultStudent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resultstudent_edit', array('id' => $resultStudent->getId()));
        }

        return $this->render('resultstudent/edit.html.twig', array(
            'resultStudent' => $resultStudent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a resultStudent entity.
     *
     * @Route("/{id}", name="resultstudent_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ResultStudent $resultStudent)
    {
        $form = $this->createDeleteForm($resultStudent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($resultStudent);
            $em->flush();
        }

        return $this->redirectToRoute('resultstudent_index');
    }

    /**
     * Creates a form to delete a resultStudent entity.
     *
     * @param ResultStudent $resultStudent The resultStudent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ResultStudent $resultStudent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resultstudent_delete', array('id' => $resultStudent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
