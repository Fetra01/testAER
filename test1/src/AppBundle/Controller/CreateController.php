<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Quizz;
use AppBundle\Entity\Survey;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Create controller.
 *
 * @Route("survey")
 */
class CreateController extends Controller{

    /**
     * @Route("/", name="surveyCreate_index")
     * @param Request $request
     * @return Response
     */

    // Creation du Titre du Questionnaire , question et proposition
    public function indexAction(Request $request){
        if($request->isMethod('GET')){
            return $this->render('Create/index.html.twig');
        }
        elseif ($request->isMethod('POST')){

            $title = $request->request->get( 'title');
            $quizz = array();
            $nbQuestion= $request->request->get('nbQuestion');

            for($i=1; $i<=$nbQuestion; $i++){
                $question = $request->request->get('question_'.$i);
                $prop1 = $request->request->get('prop1_'.$i);
                $prop2 = $request->request->get('prop2_'.$i);
                $prop3 = $request->request->get('prop3_'.$i);
                $prop4 = $request->request->get('prop4_'.$i);
                $quizz[] = array(
                    'question' => $question,
                    'proposition' => array($prop1,$prop2,$prop3,$prop4)
                );
            }

            $em = $this->getDoctrine()->getManager();

            $survey = new Survey();
            $survey->setTitle($title);
            //Envoie du question et des propositions à la bdd
            for($i=1; $i<=$nbQuestion; $i++) {
                $quizz1 = new Quizz();
                var_dump($quizz);
                $quizz1->setQuestion($quizz[$i - 1]['question']);
                //$quizz->setReponse($quizz[$i-1]['reponse']);
                $quizz1->setProposition($quizz[$i - 1]['proposition']);
                $quizz1->setSurvey($survey);
                $survey->getQuizz()->add($quizz1);

            }

            try{
                $em->persist($survey);
                $em->flush();
                $success = true;
            }
            catch(\Exception $e){
                $success = false;
                $message = $e->getMessage();
            }
            //Message d'erreur ou de succès
            if($success){
                return $this->render('Create/creatResults.html.twig', array(
                    'success' => true
                ));
            }
            else{
                return $this->render('Create/creatResults.html.twig',array(
                    'message' => $message,
                    'success' => false
                ));
            }
        }
    }
}