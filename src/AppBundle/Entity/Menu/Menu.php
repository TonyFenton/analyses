<?php

namespace AppBundle\Entity\Menu;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface as Router;

class Menu
{
    protected $items = [];
    protected $router = null;
    protected $currentRoute = null;
    protected $locale = '';

    public function __construct(Router $router, string $currentRoute, string $locale)
    {
        $this->router = $router;
        $this->currentRoute = $currentRoute;
        $this->locale = $locale;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(string $name, string $plainRoute = ''): MenuItem
    {
        $item = new MenuItem($this->router, $this->currentRoute, $this->locale);
        $item->setName($name);
        if ($plainRoute) {
            $route = $this->locale.'_'.$plainRoute;
            $url = $this->router->generate($route);
            if ($route == $this->currentRoute) {
                $item->addClass('active');
            }
        } else {
            $url = '';
        }
        $item->setUrl($url);
        $this->items[] = $item;

        return $item;
    }
}