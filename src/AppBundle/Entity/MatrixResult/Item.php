<?php

namespace AppBundle\Entity\MatrixResult;

class Item
{
    public $name = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
}
