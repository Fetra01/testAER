<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ResultTeacher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Resultteacher controller.
 *
 * @Route("resultteacher")
 */
class ResultTeacherController extends Controller
{
    /**
     * Lists all resultTeacher entities.
     *
     * @Route("/", name="resultteacher_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $resultTeachers = $em->getRepository('AppBundle:ResultTeacher')->findAll();

        return $this->render('resultteacher/index.html.twig', array(
            'resultTeachers' => $resultTeachers,
        ));
    }

    /**
     * Creates a new resultTeacher entity.
     *
     * @Route("/new", name="resultteacher_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $resultTeacher = new Resultteacher();
        $form = $this->createForm('AppBundle\Form\ResultTeacherType', $resultTeacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resultTeacher);
            $em->flush();

            return $this->redirectToRoute('resultteacher_show', array('id' => $resultTeacher->getId()));
        }

        return $this->render('resultteacher/new.html.twig', array(
            'resultTeacher' => $resultTeacher,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a resultTeacher entity.
     *
     * @Route("/{id}", name="resultteacher_show")
     * @Method("GET")
     */
    public function showAction(ResultTeacher $resultTeacher)
    {
        $deleteForm = $this->createDeleteForm($resultTeacher);

        return $this->render('resultteacher/show.html.twig', array(
            'resultTeacher' => $resultTeacher,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing resultTeacher entity.
     *
     * @Route("/{id}/edit", name="resultteacher_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ResultTeacher $resultTeacher)
    {
        $deleteForm = $this->createDeleteForm($resultTeacher);
        $editForm = $this->createForm('AppBundle\Form\ResultTeacherType', $resultTeacher);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resultteacher_edit', array('id' => $resultTeacher->getId()));
        }

        return $this->render('resultteacher/edit.html.twig', array(
            'resultTeacher' => $resultTeacher,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a resultTeacher entity.
     *
     * @Route("/{id}", name="resultteacher_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ResultTeacher $resultTeacher)
    {
        $form = $this->createDeleteForm($resultTeacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($resultTeacher);
            $em->flush();
        }

        return $this->redirectToRoute('resultteacher_index');
    }

    /**
     * Creates a form to delete a resultTeacher entity.
     *
     * @param ResultTeacher $resultTeacher The resultTeacher entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ResultTeacher $resultTeacher)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resultteacher_delete', array('id' => $resultTeacher->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
