<?php

namespace AppBundle\Entity\Matrix\Forms;

class ItemForm
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