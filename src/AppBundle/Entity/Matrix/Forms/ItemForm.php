<?php

namespace AppBundle\Entity\Matrix\Forms;

use Symfony\Component\Validator\Constraints as Assert;

class ItemForm
{
    /**
     * @Assert\Length(max = 255)
     */
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