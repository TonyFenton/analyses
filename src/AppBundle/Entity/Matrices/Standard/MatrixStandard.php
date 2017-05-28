<?php

namespace AppBundle\Entity\Matrices\Standard;

class MatrixStandard
{
    private $name = '';
    private $cells = [];

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

    public function setCells(array $cells)
    {
        foreach ($cells as $cell) {
            $standardCell = new StandardCell();
            $standardCell->setName($cell['name']);
            $standardCell->setItems($cell['items']);
            $this->cells[] = $standardCell;
        }

        return $this;
    }

    public function newCell(string $name, array $itemsNames = [])
    {
        $cell = new StandardCell();
        $cell->setName($name);
        foreach ($itemsNames as $itemName) {
            $item = new StandardItem();
            $item->setName($itemName);
            $cell->addItem($item);
        }

        return $this->addCell($cell);
    }
}
