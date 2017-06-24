<?php

namespace AppBundle\Entity\Menu;

class MenuItem extends Menu
{
    private $name = '';
    private $url = '';
    private $class = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function addClass(string $class)
    {
        if ($this->class != '') {
            $class = ' '.$class;
        }
        $this->class .= $class;

        return $this;
    }
}