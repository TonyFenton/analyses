<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\ORM\AbstractMatrixFixtures;

class MatrixFixtures extends AbstractMatrixFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->em = $manager;

        $this->setMatrix('Company XYZ', 'user_0');
        $this->setMatrix('Test', 'user_2');

        $this->em->flush();
    }
}