<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractCellFixtures;

class CellFixtures extends AbstractCellFixtures
{
    protected function setFixtures()
    {
        $this->setCell('matrix_0', 'Helpful');
        $this->setCell('matrix_0', 'My name for Harmful');
        $this->setCell('matrix_0', 'Internal');
        $this->setCell('matrix_0', 'Strengths');
        $this->setCell('matrix_0', 'Weaknesses');
        $this->setCell('matrix_0', 'External');
        $this->setCell('matrix_0', 'Opportunities');
        $this->setCell('matrix_0', 'Threats');

        $this->setCell('matrix_1', 'Test 0');
        $this->setCell('matrix_1', 'Test 1');
        $this->setCell('matrix_1', 'Test 2');
        $this->setCell('matrix_1', 'Test 3');
        $this->setCell('matrix_1', 'Test 4');
        $this->setCell('matrix_1', 'Test 5');
        $this->setCell('matrix_1', 'Test 6');
        $this->setCell('matrix_1', 'Test 7');
    }
}