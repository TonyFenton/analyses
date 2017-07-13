<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\AbstractUserFixtures;

class UserFixtures extends AbstractUserFixtures
{
    protected function setFixtures()
    {
        $this->setUser('user', 'user@email.com', 'user');
        $this->setUser('testuser', 'test@example.com', 'p@ssword');
        $this->setUser('Kapitan Nemo', 'kapitan-nemo@example.com', 'nautilus'); // username to lowercase
    }
}