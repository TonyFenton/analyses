<?php

namespace AppBundle\Utils\Matrices\Converters\Text;

use AppBundle\Entity\Matrices\Standard\MatrixStandard;

class SwotToTextConverter extends ToText
{
    private $cells = [];
    private $listsFactorsPositions = [];
    private $listsPositions = [];

    function __construct(MatrixStandard $matrixStandard)
    {
        parent::__construct($matrixStandard);
        $this->cells = $this->matrixStandard->getCells();
        $swot = new SwotText();
        $this->listsPositions = $swot->getListsPositions();
        $this->listsFactorsPositions = $swot->getListsFactorsPositions();
    }

    protected function createCell(int $cellPosition): string
    {
        if (in_array($cellPosition, $this->listsPositions)) {
            $text = PHP_EOL;
            $text .= $this->createCellName(
                $this->cells[$cellPosition]->getName(),
                mb_strtolower($this->cells[$this->listsFactorsPositions[$cellPosition][0]]->getName()),
                mb_strtolower($this->cells[$this->listsFactorsPositions[$cellPosition][1]]->getName())
            );
            $text .= PHP_EOL;
            $text .= $this->createItems($this->cells[$cellPosition]->getItems());
        } else {
            $text = '';
        }

        return $text;
    }

    private function createCellName(string $name, string $factor1, string $factor2): string
    {
        $text = $name === '' ? '' : $name.' ';
        if ($factor1 !== '') {
            $text .= "($factor1";
            if ($factor2 !== '') {
                $text .= ", $factor2";
            }
            $text .= '):';
        } elseif ($factor2 !== '') {
            $text = "($factor2):";
        } else {
            $text = substr($text, 0, -1).':';
        }

        return $text;
    }
}