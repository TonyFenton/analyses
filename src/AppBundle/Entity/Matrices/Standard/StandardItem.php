<?php

namespace AppBundle\Entity\Matrices\Standard;

use Symfony\Component\Serializer\Annotation\Groups;

class StandardItem
{
    public $name = '';

    /**
     * @Groups({"converter"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @Groups({"converter"})
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
}
