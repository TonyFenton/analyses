<?php

namespace AppBundle\Entity\Matrices\View;

abstract class AbstractView
{
    protected $name = '';

    protected $class = '';

    protected $id = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function addClass(string $class)
    {
        if ($this->class != '') {
            $class = ' '.$class;
        }
        $this->class .= $class;

        return $this;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }
}