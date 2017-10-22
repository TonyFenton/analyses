<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix\AbstractMatrixFixtures;

class MatrixFixtures extends AbstractMatrixFixtures
{
    protected function setFixtures()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->setMatrix('type_0', 'Company XYZ '.$i, 'user_0');
            $this->setMatrix('type_0', 'Test '.$i, 'user_0');
            $this->setMatrix('type_0', 'Test '.$i, 'user_2');
            $this->setMatrix('type_1', 'Lorem ipsum '.$i, 'user_0');
        }
    }
}
