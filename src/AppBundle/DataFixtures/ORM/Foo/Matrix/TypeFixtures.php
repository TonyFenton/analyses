<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix\AbstractTypeFixtures;

class TypeFixtures extends AbstractTypeFixtures
{
    protected function setFixtures()
    {
        $this->setType('swot');
        $this->setType('pest');
    }
}
