<?php

namespace Tests\AppBundle\Entity\MatrixView;

use AppBundle\Entity\MatrixView\Row;
use AppBundle\Entity\MatrixView\Cell;
use PHPUnit\Framework\TestCase;

class RowTest extends TestCase
{
    private $row = null;

    public function setUp()
    {
        $this->row = new Row();
    }

    public function testAddCell()
    {
        $cell = new Cell();
        $cell->setId('awesome-id')->setFieldName('awesome_name');
        $cell2 = new Cell();

        $this->row->setId('a-row')->addCell($cell);
        $this->row->setId('b-row')->addCell($cell2);

        $this->assertSame('awesome-id', $this->row->getCells()[0]->getId());
        $this->assertSame('awesome_name', $this->row->getCells()[0]->getFieldName());
        $this->assertSame('a1_items', $this->row->getCells()[0]->getItemsName());
        $this->assertSame('b2-cell', $this->row->getCells()[1]->getId());
        $this->assertSame('b2_field', $this->row->getCells()[1]->getFieldName());
        $this->assertSame('b2_items', $this->row->getCells()[1]->getItemsName());
    }
}