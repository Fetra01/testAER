<?php

namespace AppBundle\Controller;

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

class AnswerController extends Controller{

    /**
     * @Route("/", name="ResultStudent_index")
     */
    public function indexAction(){
        $surveyRepository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Survey');
        $listSurvey = $surveyRepository->findBy(array(),array('title' => 'ASC'));
        return $this->render('Answer/index.html.twig', array('listSurvey'=>$listSurvey));
    }

    /*
     * @Route("/renseigner/{id}",name="ResultStudentrenseigner_index")
     */
    public function renseignerAction(Request $request,$id){
        $surveyRepository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Quizz');
        $titre = $this->getDoctrine()->getManager()->getRepository('AppBundle:Survey')->find($id);
        $survey=$surveyRepository;

        foreach($survey as $quizz){
            $props = $quizz->getProposition();
            $quizz->setProposition($props);
        }
    }

}