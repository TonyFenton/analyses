<?php

namespace AppBundle\Entity\Matrices\Form;

interface IMatrixForm
{
    public function getName(): string;

    public function setName($name);
}