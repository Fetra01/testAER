<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * ResultStudent
 *
 * @ORM\Table(name="result_student")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultStudentRepository")
 */
class ResultStudent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="student", type="string", length=255)
     */
    private $student;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Quizz",cascade={"persist", "remove", "merge"} )
     *
     */
    private $quizz;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbQuestion;

    /**
     * @ORM\Column(type="string")
     */
    private $response; //Réponse à la question



    /**
     * Get id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set student
     *
     * @param mixed $student
     *
     * @return ResultStudent
     */
    public function setStudent($student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return mixed
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set quizz
     *
     * @param mixed $quizz
     *
     * @return ResultStudent
     */
    public function setQuizz($quizz)
    {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * Get quizz
     *
     * @return mixed
     */
    public function getQuizz()
    {
        return $this->quizz;
    }

    /**
     * @return mixed
     */
    public function getNbQuestion()
    {
        return $this->nbQuestion;
    }

    /**
     * @param mixed $nbQuestion
     */
    public function setNbQuestion($nbQuestion)
    {
        $this->nbQuestion = $nbQuestion;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}

