<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

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
     *@ManyToOne(targetEntity="Promo")
     *@JoinColumn(name="promo_id",referencedColumnName="id")
     */
    private $promo;

    public function __toString()
    {
        return $this->lastName.' '.$this->firstName;
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

