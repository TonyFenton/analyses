<?php

namespace AppBundle\Utils\Matrices\Converters\Text;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;

abstract class ToText
{
    protected $matrixStandard = null;

    function __construct(MatrixStandard $matrixStandard)
    {
        $this->matrixStandard = $matrixStandard;
    }

    public function convert(): string
    {
        $text = $this->matrixStandard->getName().PHP_EOL;
        $cellsQty = count($this->matrixStandard->getCells());
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