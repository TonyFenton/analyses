<?php

namespace Tests\AppBundle\Entity\Matrices\View;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrices\View\CellView;

class CellViewTest extends TestCase
{
    private $view = null;

    public function setUp()
    {
        $this->view = new CellView();
    }

    public function testAddClass()
    {
        $this->view->addClass('awesome')->addClass('test');
        $this->assertSame('cell awesome test', $this->view->getClass());
    }
}