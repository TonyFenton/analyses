<?php

namespace AppBundle\Entity\Matrix\Forms;

use Symfony\Component\Validator\Constraints as Assert;

class ItemForm
{
    /**
     * @Assert\Length(max = 255, maxMessage = "matrix.max_length_255")
     */
    private $name = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): ItemForm
    {
        $this->name = (string)$name;

        return $this;
    }
}