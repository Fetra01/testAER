<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResultTeacher
 *
 * @ORM\Table(name="result_teacher")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultTeacherRepository")
 */
class ResultTeacher
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ResultStudent",cascade={"persist", "remove", "merge"} )
     */
    private $student;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Quizz",cascade={"persist", "remove", "merge"} )
     */
    private $quizz;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbQuestion;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set student
     *
     * @param string $student
     *
     * @return ResultTeacher
     */
    public function setStudent($student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return string
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set quizz
     *
     * @param string $quizz
     *
     * @return ResultTeacher
     */
    public function setQuizz($quizz)
    {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * Get quizz
     *
     * @return string
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
}

