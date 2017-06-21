<?php

namespace AppBundle\Utils\Matrix\Converters;

abstract class AbstractSwot
{
    private $rowsQty = 3;
    private $columnsQty = 3;
    private $listsPositions = [3, 4, 6, 7];
    private $factorsPositions = [0, 1, 2, 5];

    public function getRowsQty(): int
    {
        return $this->rowsQty;
    }

    public function getColumnsQty(): int
    {
        return $this->columnsQty;
    }

    public function getListsPositions(): array
    {
        return $this->listsPositions;
    }

    public function getFactorsPositions(): array
    {
        return $this->factorsPositions;
    }
}