<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;
use Doctrine\ORM\Mapping\OneToMany as OneToMany;

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
     *@ManyToOne(targetEntity="Teacher")
     *@JoinColumn(name="teacher_id",referencedColumnName="id")
     * @ORM\Column(name="teacher_id", type="string", length=255)
     */
    private $teacher;

    /**
     * @var string
     *@ManyToOne(targetEntity="Survey")
     *@JoinColumn(name="Survey_id",referencedColumnName="id")
     * @ORM\Column(name="survey_id", type="string", length=255)
     */
    private $survey;

    /**
     * @var array
     * @OneToMany(targetEntity="ResultStudent", mappedBy="id")
     * @JoinColumn(name="resultStudent_id",referencedColumnName="id")
     * @ORM\Column(name="resultStudent_id", type="string", length=255)
     */
    private $resultStudent;


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
     * Set teacher
     *
     * @param string $teacher
     *
     * @return ResultTeacher
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return string
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set survey
     *
     * @param string $survey
     *
     * @return ResultTeacher
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
     * Set resultStudent
     *
     * @param string $resultStudent
     *
     * @return ResultTeacher
     */
    public function setResultStudent($resultStudent)
    {
        $this->resultStudent = $resultStudent;

        return $this;
    }

    /**
     * Get resultStudent
     *
     * @return string
     */
    public function getResultStudent()
    {
        return $this->resultStudent;
    }
}

