<?php

namespace AppBundle\Utils\Matrix\Converters\Html;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrix\Matrix;

class ToHtmlConverter
{
    /** @var Matrix */
    private $matrix;

    /** @var ArrayCollection */
    private $cells;

    /** @var int */
    private $columnsQty;

    /** @var string */
    private $style;

    public function __construct(Matrix $matrix, ArrayCollection $cells, int $columnsQty, string $style = '')
    {
        $this->matrix = $matrix;
        $this->cells = $cells;
        $this->columnsQty = $columnsQty;
        $this->style = $style;
    }

    public function convert(): string
    {
        $page = $this->createPage();
        $ownerDoc = dom_import_simplexml($page)->ownerDocument;
        $ownerDoc->formatOutput = true;

        return $ownerDoc->saveXML($ownerDoc->documentElement);
    }

    private function createPage(): \SimpleXMLElement
    {
        $page = new \SimpleXMLElement('<html/>');
        $this->createHead($page);
        $this->createBody($page);

        return $page;
    }

    private function createHead(\SimpleXMLElement $page): \SimpleXMLElement
    {
        $head = $page->addChild('head');
        $head->addChild('meta')->addAttribute('charset', 'UTF-8');
        $head->addChild('title', $this->matrix->getName());
        if ('' !== $this->style) {
            $head->addChild('style', $this->style);
        }

        return $head;
    }

    private function createBody(\SimpleXMLElement $page): \SimpleXMLElement
    {
        $body = $page->addChild('body');
        $body->addChild('h1', $this->matrix->getName());
        $div = $body->addChild('div');
        $div->addAttribute('class', 'analysis');
        $this->createTable($div);

        return $body;
    }

    private function createTable(\SimpleXMLElement $parent): \SimpleXMLElement
    {
        $table = $parent->addChild('table');
        $i = 0;
        foreach ($this->cells as $cell) {
            if ($i % $this->columnsQty === 0) {
                $row = $table->addChild('tr');
            }
            $this->createCell($row, $cell->getName(), $cell->getItems());
            $i++;
        }

        return $table;
    }

    private function createCell(\SimpleXMLElement $row, string $title, ArrayCollection $items = null): \SimpleXMLElement
    {
        if ('' === $title) {
            $cell = $row->addChild('td', ' ');
        } else {
            $cell = $row->addChild('td');
            $cell->addChild('span', $title);
        }
        if (!$items->isEmpty()) {
            $list = $cell->addChild('ul');
            foreach ($items as $item) {
                $list->addChild('li', $item->getName());
            }
        }

        return $cell;
    }
}
