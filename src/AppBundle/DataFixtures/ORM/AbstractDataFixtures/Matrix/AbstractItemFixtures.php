<?php

namespace AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\AbstractDataFixtures;
use AppBundle\Entity\Matrix\Item;

abstract class AbstractItemFixtures extends AbstractDataFixtures
{
    protected function setItem(string $cell, string $name): AbstractItemFixtures
    {
        $item = new Item();
        $item->setName($name);
        $item->setCell($this->getReference($cell));

        $this->em->persist($item);

        return $this;
    }

    public function getOrder(): int
    {
        return 50;
    }
}
