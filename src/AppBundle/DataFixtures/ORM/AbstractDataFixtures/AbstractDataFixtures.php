<?php

namespace AppBundle\DataFixtures\ORM\AbstractDataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

abstract class AbstractDataFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    protected $refCounter = 0;
    protected $em = null;

    abstract protected function setFixtures();

    public function load(ObjectManager $manager)
    {
        $this->em = $manager;
        $this->setFixtures();
        $this->em->flush();
    }
}