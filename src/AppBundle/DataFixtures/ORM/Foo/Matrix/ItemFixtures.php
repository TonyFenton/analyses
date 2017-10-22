<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix\AbstractItemFixtures;

class ItemFixtures extends AbstractItemFixtures
{
    protected function setFixtures()
    {
        $j = 0;
        for ($i = 0; $i < 10; $i++) {
            $j += 3;
            $this->setItem('cell_'.$j, 'Great localization');
            $this->setItem('cell_'.$j, 'Good Idea');
            $j++;
            $this->setItem('cell_'.$j, 'Strong competition');
            $this->setItem('cell_'.$j, 'Tough Clients');
            $this->setItem('cell_'.$j, 'Lack of expirance');
            $j += 2;
            $this->setItem('cell_'.$j, 'Earn lots of money');
            $j += 2;

            for ($k = 0; $k < 2; $k++) {
                $j += 3;
                $this->setItem('cell_'.$j, 'Test 3.0');
                $this->setItem('cell_'.$j, 'Test 3.2');
                $this->setItem('cell_'.$j, 'Test 3.1');
                $j++;
                $this->setItem('cell_'.$j, 'Test 4.0');
                $this->setItem('cell_'.$j, 'Test 4.1');
                $this->setItem('cell_'.$j, 'Test 4.2');
                $this->setItem('cell_'.$j, 'Test 4.3');
                $j += 2;
                $this->setItem('cell_'.$j, 'Test 6.0');
                $this->setItem('cell_'.$j, 'Test 6.1');
                $this->setItem('cell_'.$j, 'Test 6.2');
                $this->setItem('cell_'.$j, 'Test 6.3');
                $this->setItem('cell_'.$j, 'Test 6.4');
                $this->setItem('cell_'.$j, 'Test 6.5');
                $j++;
                $this->setItem('cell_'.$j, 'Test 7.0');
                $this->setItem('cell_'.$j, 'Test 7.1');
                $this->setItem('cell_'.$j, 'Test 7.2');
                $this->setItem('cell_'.$j, 'Test 7.3');
                $this->setItem('cell_'.$j, 'Test 7.4');
                $this->setItem('cell_'.$j, 'Test 7.5');
                $this->setItem('cell_'.$j, 'Test 7.6');
                $j++;
            }

            $this->setItem('cell_'.$j, 'Dolor sit amet');
            $this->setItem('cell_'.$j, 'Consectetur adipiscing elit');
            $this->setItem('cell_'.++$j, 'Etiam eget lacinia');
            $this->setItem('cell_'.$j, 'Nulla facilisi. Proin in suscipit augue');
            $this->setItem('cell_'.$j, 'Vivamus pellentesque sem nec sapien');
            $this->setItem('cell_'.$j, 'Quisque nunc dui');
            $this->setItem('cell_'.$j, 'Placerat bibendum imperdiet');
            $this->setItem('cell_'.++$j, 'Phasellus sollicitudin neque et leo sodales tempus');
            $this->setItem('cell_'.++$j, 'Sed et elit efficitur');
            $this->setItem('cell_'.$j, 'In vitae lacus non libero sodales sodales');
            $this->setItem('cell_'.$j, 'Cras semper urna sodales');
            $j++;
        }
    }
}
