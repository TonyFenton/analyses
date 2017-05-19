<?php

namespace AppBundle\Entity\MatrixForm;

class Item
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