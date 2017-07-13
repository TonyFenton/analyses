<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix\AbstractMatrixFixtures;

class MatrixFixtures extends AbstractMatrixFixtures
{
    protected function setFixtures()
    {
        $this->setMatrix('type_0', 'Company XYZ', 'user_0');
        $this->setMatrix('type_1', 'Test', 'user_2');
    }
}