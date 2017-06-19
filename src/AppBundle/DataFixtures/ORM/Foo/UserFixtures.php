<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\ORM\AbstractUserFixtures;

class UserFixtures extends AbstractUserFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->em = $manager;

        $this->setUser('user', 'user@email.com', 'user');
        $this->setUser('testuser', 'test@example.com', 'p@ssword');
        $this->setUser('Kapitan Nemo', 'kapitan-nemo@example.com', 'nautilus'); // username to lowercase

        $this->em->flush();
    }
}