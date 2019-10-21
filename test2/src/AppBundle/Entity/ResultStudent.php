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
     * @ORM\Column(name="student_id", type="string", length=255)
     * @ManyToOne(targetEntity="Student")
     *@JoinColumn(name="student_id",referencedColumnName="id")
     */
    private $student;

    /**
     * @var string
     *@ManyToOne(targetEntity="Survey")
     *@JoinColumn(name="Survey_id",referencedColumnName="id")
     * @ORM\Column(name="survey_id", type="string", length=255)
     */
    private $survey;


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
}

