<?php

namespace AppBundle\Entity\Matrices\Standard;

class StandardItem
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
