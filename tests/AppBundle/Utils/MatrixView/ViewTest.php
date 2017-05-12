<?php

namespace Tests\AppBundle\Utils\MatrixView;

use AppBundle\Utils\MatrixView\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    private $view = null;

    public function setUp()
    {
        $this->view = new View();
    }

    public function testAddClass()
    {
        $this->view->addClass('awesome')->addClass('test');
        $this->assertSame('awesome test', $this->view->getClass());
    }
}