<?php

namespace AppBundle\Entity\Matrix\Forms;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class SwotForm implements MatrixFormInterface
{
    /**
     * @Assert\NotBlank(message = "matrix.name.not_blank")
     * @Assert\Length(max = 255, maxMessage = "matrix.name.max_length_255")
     */
    private $name = '';

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $a2field = '';

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $a3field = '';

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $b1field = '';

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $b2field = '';

    private $b2items = null;

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $b3field = '';

    private $b3items = null;

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $c1field = '';

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $c2field = '';

    private $c2items = null;

    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $c3field = '';

    private $c3items = null;

    private $theme;

    private $canvas = '';

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

    public function setName($name): MatrixFormInterface
    {
        $this->name = (string)$name;

        return $this;
    }

    public function getA2field(): string
    {
        return $this->a2field;
    }

    public function setA2field($a2field): SwotForm
    {
        $this->a2field = (string)$a2field;

        return $this;
    }

    public function getA3field(): string
    {
        return $this->a3field;
    }

    public function setA3field($a3field): SwotForm
    {
        $this->a3field = (string)$a3field;

        return $this;
    }

    public function getB1field(): string
    {
        return $this->b1field;
    }

    public function setB1field($b1field): SwotForm
    {
        $this->b1field = (string)$b1field;

        return $this;
    }

    public function getB2field(): string
    {
        return $this->b2field;
    }

    public function setB2field($b2field): SwotForm
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

    public function setC1field($c1field): SwotForm
    {
        $this->c1field = (string)$c1field;

        return $this;
    }

    public function getC2field(): string
    {
        return $this->c2field;
    }

    public function setC2field($c2field): SwotForm
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

    public function setC3field($c3field): SwotForm
    {
        $this->c3field = (string)$c3field;

        return $this;
    }

    public function getC3items()
    {
        return $this->c3items;
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