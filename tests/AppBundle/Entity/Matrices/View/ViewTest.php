<?php

namespace Tests\AppBundle\Entity\MatrixView;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrices\View\View;

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