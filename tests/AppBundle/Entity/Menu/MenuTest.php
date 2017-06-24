<?php

namespace Tests\AppBundle\Entity\Menu;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as Router;
use AppBundle\Entity\Menu\Menu;

class MenuTest extends TestCase
{
    public function testAddItem()
    {
        $menu = $this->getMenu();

        $level0 = $menu->getItems();
        $this->assertSame('name 0.', $level0[0]->getName());
        $this->assertSame('fr_some_route', $level0[0]->getUrl());
        $this->assertSame('super test class', $level0[0]->getClass());

        $level01 = $level0[1]->getItems();
        $this->assertSame('name 1.0.', $level01[0]->getName());
        $this->assertEmpty($level01[0]->getUrl());
        $this->assertSame('name 1.2.', $level01[2]->getName());

        $level011 = $level01[1]->getItems();
        $this->assertSame('name 1.1.0.', $level011[0]->getName());
        $this->assertSame('active', $level011[0]->getClass());
    }

    private function getMenu()
    {
        $menu = new Menu($this->getRouter(), 'fr_some_route_active', 'fr');
        $menu->addItem('name 0.', 'some_route')->addClass('super')->addClass('test')->addClass('class');
        $menu1 = $menu->addItem('name 1.', 'some_route');
        $menu->addItem('name 2.', '');

        $menu1->addItem('name 1.0.', '');
        $menu11 = $menu1->addItem('name 1.1.', 'some_route');
        $menu1->addItem('name 1.2.', '');

        $menu11->addItem('name 1.1.0.', 'some_route_active');

        return $menu;
    }

    private function getRouter()
    {
        $router = $this->createMock(Router::class);
        $router->method('generate')->will($this->returnArgument(0));

        return $router;
    }
}