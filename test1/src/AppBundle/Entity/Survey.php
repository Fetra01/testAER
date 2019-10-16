<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Survey
 *
 * @ORM\Table(name="survey")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurveyRepository")
 */
class Survey
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Quizz",mappedBy="id",cascade={"persist", "remove", "merge"}) )
     */
    private $quizz; //Array contenant les questions

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ResultStudent",mappedBy="id", cascade={"persist", "remove", "merge"}) )
     */
    private $resultStudent;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ResultTeacher",mappedBy="id", cascade={"persist", "remove", "merge"}) )
     */
    private $resultTeacher;


    /**
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set title
     *
     * @param mixed $title
     *
     * @return Survey
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     * @param mixed $title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getResultStudent()
    {
        return $this->resultStudent;
    }

    /**
     * @param mixed $resultStudent
     */
    public function setResultStudent($resultStudent)
    {
        $this->resultStudent = $resultStudent;
    } //Array contenant les resultats

    /**
     * @return mixed
     */
    public function getResultTeacher()
    {
        return $this->resultTeacher;
    }

    /**
     * @param mixed $resultats
     */
    public function setResultTeacher($resultTeacher)
    {
        $this->resultTeacher = $resultTeacher;
    } //Array contenant les resultats

    /**
     * @return mixed
     */
    public function getQuizz()
    {
        return $this->quizz;
    }

    /**
     * @param mixed $quizz
     */
    public function setQuizz($quizz)
    {
        $this->quizz = $quizz;
    }

    public function __construct() {
        $this->resultStudent = new ArrayCollection();
        $this->resultTeacher= new ArrayCollection();
        $this->quizz= new ArrayCollection();
    }


}

