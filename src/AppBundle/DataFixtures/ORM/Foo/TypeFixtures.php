<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractTypeFixtures;

class TypeFixtures extends AbstractTypeFixtures
{
    protected function setFixtures()
    {
        $this->setType('swotek');
        $this->setType('test');
    }
}