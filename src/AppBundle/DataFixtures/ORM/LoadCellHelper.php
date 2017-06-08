<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Matrices\Standard\StandardCell;

abstract class LoadCellHelper extends AbstractFixture implements OrderedFixtureInterface
{
    private $cellRefCounter = 0;
    protected $em = null;

    protected function setCell(string $matrix, string $name): LoadCellHelper
    {
        $cell = new StandardCell();
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