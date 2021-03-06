<?php

namespace Tests\AppBundle\Entity\Matrix\View;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrix\View\CellView;

class CellViewTest extends TestCase
{
    /**
     * @var CellView
     */
    private $view;

    public function setUp()
    {
        $this->view = new CellView();
    }

    public function testAddClass()
    {
        $this->view->addClass('awesome')->addClass('test');
        $this->assertSame('matrix-cell awesome test', $this->view->getClass());
    }
}
