<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix\AbstractCellFixtures;

class CellFixtures extends AbstractCellFixtures
{
    protected function setFixtures()
    {
        $j = 0;
        for ($i = 0; $i < 10; $i++) {
            $this->setCell('matrix_'.$j, 'Helpful');
            $this->setCell('matrix_'.$j, 'My name for Harmful');
            $this->setCell('matrix_'.$j, 'Internal');
            $this->setCell('matrix_'.$j, 'Strengths');
            $this->setCell('matrix_'.$j, 'Weaknesses');
            $this->setCell('matrix_'.$j, 'External');
            $this->setCell('matrix_'.$j, 'Opportunities');
            $this->setCell('matrix_'.$j, 'Threats');
            $j++;

            for ($k = 0; $k < 2; $k++) {
                $this->setCell('matrix_'.$j, 'Test 0');
                $this->setCell('matrix_'.$j, 'Test 1');
                $this->setCell('matrix_'.$j, 'Test 2');
                $this->setCell('matrix_'.$j, 'Test 3');
                $this->setCell('matrix_'.$j, 'Test 4');
                $this->setCell('matrix_'.$j, 'Test 5');
                $this->setCell('matrix_'.$j, 'Test 6');
                $this->setCell('matrix_'.$j, 'Test 7');
                $j++;
            }

            $this->setCell('matrix_'.$j, 'Political');
            $this->setCell('matrix_'.$j, 'Economic');
            $this->setCell('matrix_'.$j, 'My name for Social');
            $this->setCell('matrix_'.$j, 'Technological');
            $j++;
        }
    }
}
