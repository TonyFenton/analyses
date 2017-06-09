<?php

namespace AppBundle\Entity\Matrices\Forms;

interface MatrixFormInterface
{
    public function getName(): string;

    public function setName($name);
}