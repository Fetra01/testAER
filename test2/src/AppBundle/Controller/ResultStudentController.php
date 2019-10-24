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
        if($request->isMethod('GET')) {
            $studentRepository= $this->getDoctrine()->getRepository('AppBundle:Student');
            $students=$studentRepository->findAll();
            $quizRepository= $this->getDoctrine()->getRepository('AppBundle:Quiz');
            $quiz=$quizRepository->find(2);
            var_dump($students[3]->getPromo()->getName());
            return $this->render('resultstudent/new.html.twig', array('students'=>$students, 'quiz' =>$quiz));
        }
        if($request->isMethod('POST')) {
            $student= $request->request->get('student');
            $studentRepository= $this->getDoctrine()->getRepository('AppBundle:Student');
            $students=$studentRepository->findBy(array('id'=>$student));
            $promo_id= $students[0]->getPromo()->getId();
            $surveyRepository= $this->getDoctrine()->getRepository('AppBundle:Survey');
            $surveys=$surveyRepository->findBy( array('promo'=>$promo_id));
            $survey_id= $surveys[0]->getId();
            $quizRepository= $this->getDoctrine()->getRepository('AppBundle:Quiz');
            $quizz=$quizRepository->findBy( array('survey'=>$survey_id));


            return $this->render('resultstudent/form.html.twig', array('survey'=>$surveys, 'quizz'=>$quizz));
        }

    }
    /**
     * Creates a form resultStudent entity.
     *
     * @Route("/form", name="resultstudent_form")
     * @Method({"GET", "POST"})
     */
    public function formAction(Request $request)
    {
        //traitement de formulaire de reponse
        if($request->isMethod('POST')) {
            var_dump($request->request->get('choice0'));
            return $this->render('resultstudent/finish.html.twig');
        }
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
