<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Matrix\Cell;

abstract class AbstractCellFixtures extends AbstractFixtures
{
    protected function setCell(string $matrix, string $name): AbstractCellFixtures
    {
        $cell = new Cell();
        $cell->setName($name);
        $cell->setMatrix($this->getReference($matrix));

        $this->em->persist($cell);
        $this->addReference('cell_'.$this->refCounter, $cell);
        $this->refCounter++;

        return $this;
    }

    public function getOrder()
    {
        return 40;
    }
}