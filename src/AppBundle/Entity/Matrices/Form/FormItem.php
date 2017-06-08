<?php

namespace AppBundle\Entity\Matrices\Form;

class FormItem
{
    private $name = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }
}