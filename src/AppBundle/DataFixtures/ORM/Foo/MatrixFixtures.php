<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\ORM\AbstractMatrixFixtures;

class MatrixFixtures extends AbstractMatrixFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->em = $manager;

        $this->setMatrix('Company XYZ');
        $this->setMatrix('Test');

        $this->em->flush();
    }
}