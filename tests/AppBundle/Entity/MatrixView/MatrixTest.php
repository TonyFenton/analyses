<?php

namespace Tests\AppBundle\Entity\MatrixView;

use AppBundle\Entity\MatrixView\Matrix;
use AppBundle\Entity\MatrixView\Row;
use PHPUnit\Framework\TestCase;

class MatrixTest extends TestCase
{
    private $matrix = null;

    public function setUp()
    {
        $this->matrix = new Matrix();
    }

    public function testAddRow()
    {
        $row = new Row();
        $row2 = new Row();
        $row2->setId('awesome-id');
        $row3 = new Row();
        $this->matrix->addRow($row)->addRow($row2)->addRow($row3);

        $this->assertSame('a-row', $this->matrix->getRows()[0]->getId());
        $this->assertSame('awesome-id', $this->matrix->getRows()[1]->getId());
        $this->assertSame('c-row', $this->matrix->getRows()[2]->getId());
    }
}