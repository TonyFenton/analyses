<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix\AbstractItemFixtures;

class ItemFixtures extends AbstractItemFixtures
{
    protected function setFixtures()
    {
        for ($i = 0; $i < 480; $i += 24) {
            $this->setItem('cell_'.($i + 3), 'Great localization');
            $this->setItem('cell_'.($i + 3), 'Good Idea');
            $this->setItem('cell_'.($i + 4), 'Strong competition');
            $this->setItem('cell_'.($i + 4), 'Tough Clients');
            $this->setItem('cell_'.($i + 4), 'Lack of expirance');
            $this->setItem('cell_'.($i + 6), 'Earn lots of money');

            for ($j = 0; $j < 16; $j += 8) {
                $ij = $i + $j;
                $this->setItem('cell_'.($ij + 11), 'Test 3.0');
                $this->setItem('cell_'.($ij + 11), 'Test 3.2');
                $this->setItem('cell_'.($ij + 11), 'Test 3.1');
                $this->setItem('cell_'.($ij + 12), 'Test 4.0');
                $this->setItem('cell_'.($ij + 12), 'Test 4.1');
                $this->setItem('cell_'.($ij + 12), 'Test 4.2');
                $this->setItem('cell_'.($ij + 12), 'Test 4.3');
                $this->setItem('cell_'.($ij + 14), 'Test 6.0');
                $this->setItem('cell_'.($ij + 14), 'Test 6.1');
                $this->setItem('cell_'.($ij + 14), 'Test 6.2');
                $this->setItem('cell_'.($ij + 14), 'Test 6.3');
                $this->setItem('cell_'.($ij + 14), 'Test 6.4');
                $this->setItem('cell_'.($ij + 14), 'Test 6.5');
                $this->setItem('cell_'.($ij + 15), 'Test 7.0');
                $this->setItem('cell_'.($ij + 15), 'Test 7.1');
                $this->setItem('cell_'.($ij + 15), 'Test 7.2');
                $this->setItem('cell_'.($ij + 15), 'Test 7.3');
                $this->setItem('cell_'.($ij + 15), 'Test 7.4');
                $this->setItem('cell_'.($ij + 15), 'Test 7.5');
                $this->setItem('cell_'.($ij + 15), 'Test 7.6');
            }
        }
    }
}