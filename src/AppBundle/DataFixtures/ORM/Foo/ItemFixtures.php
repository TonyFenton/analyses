<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\ORM\AbstractItemFixtures;

class ItemFixtures extends AbstractItemFixtures
{
    public function load(ObjectManager $manager)
    {
        $this->em = $manager;

        $this->setItem('cell_3', 'Great localization');
        $this->setItem('cell_3', 'Good Idea');
        $this->setItem('cell_4', 'Strong competition');
        $this->setItem('cell_4', 'Tough Clients');
        $this->setItem('cell_4', 'Lack of expirance');
        $this->setItem('cell_6', 'Earn lots of money');
        $this->setItem('cell_11', 'Test 3.0');
        $this->setItem('cell_11', 'Test 3.1');
        $this->setItem('cell_11', 'Test 3.2');
        $this->setItem('cell_12', 'Test 4.0');
        $this->setItem('cell_12', 'Test 4.1');
        $this->setItem('cell_12', 'Test 4.2');
        $this->setItem('cell_12', 'Test 4.3');
        $this->setItem('cell_14', 'Test 6.0');
        $this->setItem('cell_14', 'Test 6.1');
        $this->setItem('cell_14', 'Test 6.2');
        $this->setItem('cell_14', 'Test 6.3');
        $this->setItem('cell_14', 'Test 6.4');
        $this->setItem('cell_14', 'Test 6.5');
        $this->setItem('cell_15', 'Test 7.0');
        $this->setItem('cell_15', 'Test 7.1');
        $this->setItem('cell_15', 'Test 7.2');
        $this->setItem('cell_15', 'Test 7.3');
        $this->setItem('cell_15', 'Test 7.4');
        $this->setItem('cell_15', 'Test 7.5');
        $this->setItem('cell_15', 'Test 7.6');

        $this->em->flush();
    }
}