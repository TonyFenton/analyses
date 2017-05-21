<?php

namespace AppBundle\Entity\Matrices\Standard;

class StandardCell
{
    private $name = '';
    private $items = [];

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

    public function addItem(StandardItem $item)
    {
        $this->items[] = $item;

        return $this;
    }
}
