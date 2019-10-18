<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Quizz;
use AppBundle\Entity\ResultStudent;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * ResultStudent controller.
 *
 * @Route("resultstudent")
 */

class AnswerController extends Controller
{

    /**
     * @Route("/", name="ResultStudent_index")
     */
    public function indexAction()
    {
        $surveyRepository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Survey');
        $listSurvey = $surveyRepository->findBy(array(), array('title' => 'ASC'));
        return $this->render('Answer/index.html.twig', array('listSurvey' => $listSurvey));
    }

    /**
     * @Route("/resultstudent/{id}",name="resultStudentrenseigner_index")
     */
    public function renseignerAction(Request $request, $id)
    {

        $quizzRepository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Quizz');
        $title = $this->getDoctrine()->getManager()->getRepository('AppBundle:Survey')->findBy(['id'=>$id]);
        $quizz = $quizzRepository->findBy(['survey'=>$id]);



        foreach ($quizz as $quiz) {
            $props = $quiz->getProposition();
            $quiz->setProposition($props);
        }


        if ($request->isMethod('POST')) {
           // $proposition = $request->get('proposition');
            //$reponse = $request->get('response');
            //$nbReponse = 0;




            $resultStudent = new ResultStudent();
            $resultStudent->setStudent($request->request->get('student'));
            $resultStudent->setNbQuestion(count($quizz));
            $resultStudent->setQuizz($request->request->get('quiz'));
            $resultStudent->setResponse($request->request->get('response'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($resultStudent);
            $em->flush();
            $this->addFlash('success', 'Merci');
            return $this->redirectToRoute('ResultStudent_index');

        }
        return $this-> render('Answer/resultStudentrenseigner.html.twig',array('quizz'=>$quizz, 'title'=>$title));
}


}