<?php

namespace AppBundle\Entity\Matrix\Forms;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PestForm implements MatrixFormInterface
{
    /**
     * @Assert\NotBlank(message = "matrix.name.not_blank")
     * @Assert\Length(max = 255, maxMessage = "matrix.name.max_length_255")
     */
    private $name = '';

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $a1field = '';

    private $a1items = null;

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $a2field = '';

    private $a2items = null;

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $b1field = '';

    private $b1items = null;

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $b2field = '';

    private $b2items = null;

    private $theme;

    private $canvas = '';

    public function __construct()
    {
        $this->a1items = new ArrayCollection();
        $this->a2items = new ArrayCollection();
        $this->b1items = new ArrayCollection();
        $this->b2items = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): MatrixFormInterface
    {
        $this->name = (string)$name;

        return $this;
    }

    public function getA1field()
    {
        return $this->a1field;
    }

    public function setA1field($a1field)
    {
        $this->a1field = $a1field;

        return $this;
    }

    public function getA1items()
    {
        return $this->a1items;
    }

    public function setA1items($a1items)
    {
        $this->a1items = $a1items;

        return $this;
    }

    public function getA2field()
    {
        return $this->a2field;
    }

    public function setA2field($a2field)
    {
        $this->a2field = $a2field;

        return $this;
    }

    public function getA2items()
    {
        return $this->a2items;
    }

    public function setA2items($a2items)
    {
        $this->a2items = $a2items;

        return $this;
    }

    public function getB1field()
    {
        return $this->b1field;
    }

    public function setB1field($b1field)
    {
        $this->b1field = $b1field;

        return $this;
    }

    public function getB1items()
    {
        return $this->b1items;
    }

    public function setB1items($b1items)
    {
        $this->b1items = $b1items;

        return $this;
    }

    public function getB2field()
    {
        return $this->b2field;
    }

    public function setB2field($b2field)
    {
        $this->b2field = $b2field;

        return $this;
    }

    public function getB2items()
    {
        return $this->b2items;
    }

    public function setB2items($b2items)
    {
        $this->b2items = $b2items;

        return $this;
    }


    public function getTheme()
    {
        return $this->theme;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    public function getCanvas()
    {
        return $this->canvas;
    }

    public function setCanvas($canvas): MatrixFormInterface
    {
        $this->canvas = $canvas;

        return $this;
    }
}
