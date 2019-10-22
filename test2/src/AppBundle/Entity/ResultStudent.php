<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

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
     * @ManyToOne(targetEntity="Student")
     *@JoinColumn(name="student_id",referencedColumnName="id")
     */
    private $student;

    /**
     * @var string
     *@ManyToOne(targetEntity="Survey")
     *@JoinColumn(name="survey_id",referencedColumnName="id")
     */
    private $survey;

    /**
     * @var array
     *
     * @ORM\Column(name="response", type="array")
     */
    private $response;



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
     * @return string
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set survey
     *
     * @param string $survey
     *
     * @return ResultStudent
     */
    public function setSurvey($survey)
    {
        $this->survey = $survey;

        return $this;
    }

    /**
     * Get survey
     *
     * @return string
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * Set response 
     *
     * @param array $response
     *
     * @return resultstudent
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }
}

