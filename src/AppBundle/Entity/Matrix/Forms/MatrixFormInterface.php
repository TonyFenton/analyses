<?php

namespace AppBundle\Entity\Matrix\Forms;

interface MatrixFormInterface
{
    public function getName(): string;

    public function setName($name);
}