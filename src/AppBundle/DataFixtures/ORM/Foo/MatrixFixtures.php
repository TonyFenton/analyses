<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractMatrixFixtures;

class MatrixFixtures extends AbstractMatrixFixtures
{
    protected function setFixtures()
    {
        $this->setMatrix('Company XYZ', 'user_0');
        $this->setMatrix('Test', 'user_2');
    }
}