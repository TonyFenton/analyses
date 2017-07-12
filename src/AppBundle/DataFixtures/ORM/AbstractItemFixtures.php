<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Matrix\Item;

abstract class AbstractItemFixtures extends AbstractFixtures
{
    protected function setItem(string $cell, string $name): AbstractItemFixtures
    {
        $item = new Item();
        $item->setName($name);
        $item->setCell($this->getReference($cell));

        $this->em->persist($item);

        return $this;
    }

    public function getOrder()
    {
        return 50;
    }
}
