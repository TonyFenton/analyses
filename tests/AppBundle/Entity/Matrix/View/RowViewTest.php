<?php

namespace Tests\AppBundle\Entity\Matrix\View;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrix\View\RowView;
use AppBundle\Entity\Matrix\View\CellView;

class RowViewTest extends TestCase
{
    /**
     * @var RowView
     */
    private $row;

    public function setUp()
    {
        $this->row = new RowView();
    }

    public function testAddCell()
    {
        $this->row->setId('a-row');
        $this->row->addCell()->setId('awesome-id')->setFieldName('awesome_name');
        $this->row->setId('b-row');
        $this->row->addCell();

        $this->assertSame('awesome-id', $this->row->getCells()[0]->getId());
        $this->assertSame('awesome_name', $this->row->getCells()[0]->getFieldName());
        $this->assertSame('a1items', $this->row->getCells()[0]->getItemsName());
        $this->assertSame('b2-cell', $this->row->getCells()[1]->getId());
        $this->assertSame('b2field', $this->row->getCells()[1]->getFieldName());
        $this->assertSame('b2items', $this->row->getCells()[1]->getItemsName());
    }
}
