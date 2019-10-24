<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Promo;
use AppBundle\Entity\Survey;
use AppBundle\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 * Survey controller.
 *
 * @Route("survey")
 */
class SurveyController extends Controller
{
    /**
     * Lists all survey entities.
     *
     * @Route("/", name="survey_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $surveys = $em->getRepository('AppBundle:Survey')->findAll();

        return $this->render('survey/index.html.twig', array(
            'surveys' => $surveys,
        ));
    }

    /**
     * Creates a new survey entity.
     *
     * @Route("/new", name="survey_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        
        if($request->isMethod('GET')) {
            $promoRepository= $this->getDoctrine()->getRepository('AppBundle:Promo');
            $promo=$promoRepository->findAll();
            return $this->render('survey/new.html.twig', array(
                'promo'=>$promo
            ));
        }
        else if($request->isMethod('POST'))
        {

            $promoRepository= $this->getDoctrine()->getRepository('AppBundle:Promo');
            $promotion= $request->request->get('promo');

            $promo=$promoRepository->findBy(array('name'=>$promotion));
           // var_dump($promo[0]->getId());die;
            $titre = $request->request->get('titre');
            $nbQuestions = $request->request->get('nbQuestions');
            $questions = array();
            for($i=1; $i<=$nbQuestions; $i++)
            {
                $question = $request->request->get('question_'.$i);
                $prop1 = $request->request->get('prop1_'.$i);
                $prop2 = $request->request->get('prop2_'.$i);
                $prop3 = $request->request->get('prop3_'.$i);
                $prop4 = $request->request->get('prop4_'.$i);
                $prop5 = $request->request->get('prop5_'.$i);

                $questions[] = array(
                    'question' => $question,
                    'proposition' => array($prop1,$prop2,$prop3,$prop4,$prop5)
                );
            }
           $survey = new Survey();
            $survey->setTitle($titre);
            //var_dump($promo); die;
            $survey->setPromo($promo[0]);
            for($i=1; $i<=$nbQuestions; $i++)
            {
                $quiz = new Quiz();
                $quiz ->setQuestion($questions[$i-1]['question']);
                $quiz ->setProposition($questions[$i-1]['proposition']);
                $quiz ->setSurvey($survey);
                $survey->getQuiz()->add($quiz);
            }

            $em = $this->getDoctrine()->getManager();

            try{
                $em->persist($survey);
                $em->flush();
                $success = true;
            }
            catch(Exception $e){
                $success = false;
                $message = $e->getMessage();
            }
            if($success)
            {
                return $this->render('survey/show.html.twig', array(
                    'success' => true
                ));
            }
            else
            {
                return $this->render('survey/show.html.twig', array(
                    'message' => $message,
                    'success' => false
                ));
            }








            return $this->render('survey/show.html.twig');
        }


    }

    /**
     * Finds and displays a survey entity.
     *
     * @Route("/{id}", name="survey_show")
     * @Method("GET")
     */
    public function showAction(Survey $survey)
    {
        $deleteForm = $this->createDeleteForm($survey);

        return $this->render('survey/show.html.twig', array(
            'survey' => $survey,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing survey entity.
     *
     * @Route("/{id}/edit", name="survey_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Survey $survey)
    {
        $deleteForm = $this->createDeleteForm($survey);
        $editForm = $this->createForm('AppBundle\Form\SurveyType', $survey);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('survey_edit', array('id' => $survey->getId()));
        }

        return $this->render('survey/edit.html.twig', array(
            'survey' => $survey,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a survey entity.
     *
     * @Route("/{id}", name="survey_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Survey $survey)
    {
        $form = $this->createDeleteForm($survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($survey);
            $em->flush();
        }

        return $this->redirectToRoute('survey_index');
    }

    /**
     * Creates a form to delete a survey entity.
     *
     * @param Survey $survey The survey entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Survey $survey)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('survey_delete', array('id' => $survey->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
