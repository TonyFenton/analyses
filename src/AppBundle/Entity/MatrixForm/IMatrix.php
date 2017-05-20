<?php

namespace AppBundle\Entity\MatrixForm;

interface IMatrix
{
    public function getName(): string;

    public function setName($name);
}