<?php

namespace AppBundle\Entity\Matrix\Forms;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class SwotForm implements MatrixFormInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     */
    private $name = '';

    /**
     * @Assert\Length(max = 255)
     */
    private $a2field = '';

    /**
     * @Assert\Length(max = 255)
     */
    private $a3field = '';

    /**
     * @Assert\Length(max = 255)
     */
    private $b1field = '';

    /**
     * @Assert\Length(max = 255)
     */
    private $b2field = '';

    private $b2items = null;

    /**
     * @Assert\Length(max = 255)
     */
    private $b3field = '';

    private $b3items = null;

    /**
     * @Assert\Length(max = 255)
     */
    private $c1field = '';

    /**
     * @Assert\Length(max = 255)
     */
    private $c2field = '';

    /**
     * @Assert\Length(max = 255)
     */
    private $c2items = null;

    /**
     * @Assert\Length(max = 255)
     */
    private $c3field = '';

    private $c3items = null;

    public function __construct()
    {
        $this->b2items = new ArrayCollection();
        $this->b3items = new ArrayCollection();
        $this->c2items = new ArrayCollection();
        $this->c3items = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    public function getA2field(): string
    {
        return $this->a2field;
    }

    public function setA2field($a2field)
    {
        $this->a2field = (string)$a2field;

        return $this;
    }

    public function getA3field(): string
    {
        return $this->a3field;
    }

    public function setA3field($a3field)
    {
        $this->a3field = (string)$a3field;

        return $this;
    }

    public function getB1field(): string
    {
        return $this->b1field;
    }

    public function setB1field($b1field)
    {
        $this->b1field = (string)$b1field;

        return $this;
    }

    public function getB2field(): string
    {
        return $this->b2field;
    }

    public function setB2field($b2field)
    {
        $this->b2field = (string)$b2field;

        return $this;
    }

    public function getB2items()
    {
        return $this->b2items;
    }

    public function getB3field(): string
    {
        return $this->b3field;
    }

    public function setB3field($b3field)
    {
        $this->b3field = (string)$b3field;

        return $this;
    }

    public function getB3items()
    {
        return $this->b3items;
    }

    public function getC1field(): string
    {
        return $this->c1field;
    }

    public function setC1field($c1field)
    {
        $this->c1field = (string)$c1field;

        return $this;
    }

    public function getC2field(): string
    {
        return $this->c2field;
    }

    public function setC2field($c2field)
    {
        $this->c2field = (string)$c2field;

        return $this;
    }

    public function getC2items()
    {
        return $this->c2items;
    }

    public function getC3field(): string
    {
        return $this->c3field;
    }

    public function setC3field($c3field)
    {
        $this->c3field = (string)$c3field;

        return $this;
    }

    public function getC3items()
    {
        return $this->c3items;
    }
}