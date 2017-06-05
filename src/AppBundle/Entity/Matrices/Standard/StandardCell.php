<?php

namespace AppBundle\Entity\Matrices\Standard;

use Symfony\Component\Serializer\Annotation\Groups;

class StandardCell
{
    private $name = '';
    private $items = [];

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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @Groups({"converter"})
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(StandardItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @Groups({"converter"})
     */
    public function setItems(array $items)
    {
        foreach ($items as $item) {
            $standardItem = new StandardItem();
            $standardItem->setName($item['name']);
            $this->items[] = $standardItem;
        }
    }
}
