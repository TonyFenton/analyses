<?php

namespace AppBundle\Entity\Matrices\Standard;

use Symfony\Component\Serializer\Annotation\Groups;

class MatrixStandard
{
    private $name = '';
    private $cells = [];
    private $type;

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

    /**
     * @Groups({"converter"})
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    public function addCell(StandardCell $cell)
    {
        $this->cells[] = $cell;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @Groups({"converter"})
     */
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
