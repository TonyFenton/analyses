<?php

namespace AppBundle\Entity\Matrices\Form;

use Doctrine\Common\Collections\ArrayCollection;

class SwotForm implements IMatrixForm
{
    private $name = '';
    private $a2Field = '';
    private $a3Field = '';
    private $b1Field = '';
    private $b2Field = '';
    private $b2Items = null;
    private $b3Field = '';
    private $b3Items = null;
    private $c1Field = '';
    private $c2Field = '';
    private $c2Items = null;
    private $c3Field = '';
    private $c3Items = null;

    public function __construct()
    {
        $this->b2Items = new ArrayCollection();
        $this->b3Items = new ArrayCollection();
        $this->c2Items = new ArrayCollection();
        $this->c3Items = new ArrayCollection();
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

    public function getA2Field(): string
    {
        return $this->a2Field;
    }

    public function setA2Field($a2Field)
    {
        $this->a2Field = (string)$a2Field;

        return $this;
    }

    public function getA3Field(): string
    {
        return $this->a3Field;
    }

    public function setA3Field($a3Field)
    {
        $this->a3Field = (string)$a3Field;

        return $this;
    }

    public function getB1Field(): string
    {
        return $this->b1Field;
    }

    public function setB1Field($b1Field)
    {
        $this->b1Field = (string)$b1Field;

        return $this;
    }

    public function getB2Field(): string
    {
        return $this->b2Field;
    }

    public function setB2Field($b2Field)
    {
        $this->b2Field = (string)$b2Field;

        return $this;
    }

    public function getB2Items()
    {
        return $this->b2Items;
    }

    public function getB3Field(): string
    {
        return $this->b3Field;
    }

    public function setB3Field($b3Field)
    {
        $this->b3Field = (string)$b3Field;

        return $this;
    }

    public function getB3Items()
    {
        return $this->b3Items;
    }

    public function getC1Field(): string
    {
        return $this->c1Field;
    }

    public function setC1Field($c1Field)
    {
        $this->c1Field = (string)$c1Field;

        return $this;
    }

    public function getC2Field(): string
    {
        return $this->c2Field;
    }

    public function setC2Field($c2Field)
    {
        $this->c2Field = (string)$c2Field;

        return $this;
    }

    public function getC2Items()
    {
        return $this->c2Items;
    }

    public function getC3Field(): string
    {
        return $this->c3Field;
    }

    public function setC3Field($c3Field)
    {
        $this->c3Field = (string)$c3Field;

        return $this;
    }

    public function getC3Items()
    {
        return $this->c3Items;
    }
}