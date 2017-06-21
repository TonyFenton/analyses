<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Matrix\Item;

abstract class AbstractItemFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    protected $em = null;

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
        return 40;
    }
}
