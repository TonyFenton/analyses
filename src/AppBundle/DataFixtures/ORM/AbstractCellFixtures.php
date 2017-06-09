<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Matrices\Cell;

abstract class AbstractCellFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    private $cellRefCounter = 0;
    protected $em = null;

    protected function setCell(string $matrix, string $name): AbstractCellFixtures
    {
        $cell = new Cell();
        $cell->setName($name);
        $cell->setMatrix($this->getReference($matrix));

        $this->em->persist($cell);
        $this->addReference('cell_'.$this->cellRefCounter, $cell);
        $this->cellRefCounter++;

        return $this;
    }

    public function getOrder()
    {
        return 30;
    }
}