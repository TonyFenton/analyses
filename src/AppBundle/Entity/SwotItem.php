<?php

namespace AppBundle\Entity;

class SwotItem
{
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }




}