<?php

namespace AppBundle\Entity\Matrix\Forms;

interface MatrixFormInterface
{
    public function getName(): string;

    public function setName($name): MatrixFormInterface;

    public function getCanvas();

    public function setCanvas($canvas): MatrixFormInterface;
}
