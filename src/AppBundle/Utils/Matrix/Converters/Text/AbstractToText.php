<?php

namespace AppBundle\Utils\Matrix\Converters\Text;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrix\Matrix;

abstract class AbstractToText
{
    protected $matrix = null;

    function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }

    public function convert(): string
    {
        $text = $this->matrix->getName().PHP_EOL;
        $cellsQty = count($this->matrix->getCells());
        for ($i = 0; $i < $cellsQty; $i++) {
            $text .= $this->createCell($i);
        }

        return $text;
    }

    abstract protected function createCell(int $cellPosition);

    protected function createItems(ArrayCollection $items): string
    {
        $text = '';
        $itemsQty = count($items);
        $i = 1;
        foreach ($items as $item) {
            $text .= '- '.$item->getName();
            $text .= $i < $itemsQty ? ','.PHP_EOL : '.';
            $i++;
        }

        return $text;
    }
}