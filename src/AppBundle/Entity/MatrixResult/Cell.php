<?php

namespace AppBundle\Entity\MatrixResult;

class Cell
{
    public $name = '';
    public $items = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }
}
