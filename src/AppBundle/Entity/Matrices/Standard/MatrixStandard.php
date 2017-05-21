<?php

namespace AppBundle\Entity\Matrices\Standard;

class MatrixStandard
{
    public $name = '';
    public $cells = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getCells(): array
    {
        return $this->cells;
    }

    public function addCell(StandardCell $cell)
    {
        $this->cells[] = $cell;

        return $this;
    }
}
