<?php

namespace Tests\AppBundle\Entity\Matrices\View;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrices\View\MatrixView;
use AppBundle\Entity\Matrices\View\RowView;

class MatrixViewTest extends TestCase
{
    private $matrix = null;

    public function setUp()
    {
        $this->matrix = new MatrixView();
    }

    public function testAddRow()
    {
        $row = new RowView();
        $row2 = new RowView();
        $row2->setId('awesome-id');
        $row3 = new RowView();
        $this->matrix->addRow($row)->addRow($row2)->addRow($row3);

        $this->assertSame('a-row', $this->matrix->getRows()[0]->getId());
        $this->assertSame('awesome-id', $this->matrix->getRows()[1]->getId());
        $this->assertSame('c-row', $this->matrix->getRows()[2]->getId());
    }
}