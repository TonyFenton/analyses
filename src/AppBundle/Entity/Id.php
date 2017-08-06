<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Id
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     */
    private $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Id
    {
        $this->id = $id;

        return $this;
    }
}