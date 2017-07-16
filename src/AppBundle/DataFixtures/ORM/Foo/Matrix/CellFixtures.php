<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix\AbstractCellFixtures;

class CellFixtures extends AbstractCellFixtures
{
    protected function setFixtures()
    {
        for ($i = 0; $i < 60; $i += 3) {
            $this->setCell('matrix_'.$i, 'Helpful');
            $this->setCell('matrix_'.$i, 'My name for Harmful');
            $this->setCell('matrix_'.$i, 'Internal');
            $this->setCell('matrix_'.$i, 'Strengths');
            $this->setCell('matrix_'.$i, 'Weaknesses');
            $this->setCell('matrix_'.$i, 'External');
            $this->setCell('matrix_'.$i, 'Opportunities');
            $this->setCell('matrix_'.$i, 'Threats');

            for ($j = 1; $j < 3; $j++) {
                $ij = $i + $j;
                $this->setCell('matrix_'.$ij, 'Test 0');
                $this->setCell('matrix_'.$ij, 'Test 1');
                $this->setCell('matrix_'.$ij, 'Test 2');
                $this->setCell('matrix_'.$ij, 'Test 3');
                $this->setCell('matrix_'.$ij, 'Test 4');
                $this->setCell('matrix_'.$ij, 'Test 5');
                $this->setCell('matrix_'.$ij, 'Test 6');
                $this->setCell('matrix_'.$ij, 'Test 7');
            }
        }
    }
}