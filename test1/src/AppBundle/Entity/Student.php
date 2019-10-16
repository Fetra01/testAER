<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentRepository")
 */
class Student extends User
{


    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Promotion",cascade={"persist", "remove", "merge"})
     */
    private $promo;

    /**
     * tostring
     *
     *
     * @return string
     */

    public function __toString()
    {
        return $this->lastname.' '.$this->firstname;
    }


    /**
     * Set promo
     *
     * @param string $promo
     *
     * @return Student
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
}

