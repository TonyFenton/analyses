<?php

namespace Tests\AppBundle\Entity\Matrix\View;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrix\View\MatrixView;

class MatrixViewTest extends TestCase
{
    /**
     * @var MatrixView
     */
    private $matrix;

    public function setUp()
    {
        $this->matrix = new MatrixView();
    }

    public function testAddRow()
    {
        $this->matrix->addRow();
        $this->matrix->addRow()->setId('awesome-id');
        $this->matrix->addRow();

        $this->assertSame('a-row', $this->matrix->getRows()[0]->getId());
        $this->assertSame('awesome-id', $this->matrix->getRows()[1]->getId());
        $this->assertSame('c-row', $this->matrix->getRows()[2]->getId());
    }
}
