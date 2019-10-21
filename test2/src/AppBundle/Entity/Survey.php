<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany as OneToMany;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;
use Doctrine\ORM\Mapping\OneToOne as OneToOne;
use Doctrine\Common\Collections\ArrayCollection;


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
     * @var array
     *
     * @OneToMany(targetEntity="Quiz", mappedBy="id", cascade={"persist", "remove", "merge"})
     * @JoinColumn(name="quiz_id",referencedColumnName="id")
     */
    private $quiz;

    /**
     * @var string
     *
     * @OneToOne(targetEntity="Promo")
     * @JoinColumn(name="promo_id",referencedColumnName="id")
     */
    private $promo;

    public function __toString()
    {
        return $this->title;
    }

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
     * Set title
     *
     * @param string $title
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
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set quiz
     *
     * @param mixed $quiz
     *
     * @return Survey
     */
    public function setquiz($quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz
     *
     * @return mixed
     */
    public function getquiz()
    {
        return $this->quiz;
    }

    /**
     * Set promo
     *
     * @param string $promo
     *
     * @return Survey
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return string
     */
    public function getPromo()
    {
        return $this->promo;
    }

    public function __construct() {
        $this->quiz= new ArrayCollection();
    }
}

