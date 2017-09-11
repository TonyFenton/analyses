<?php

namespace AppBundle\Utils\Matrix\Converters\Text;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrix\Matrix;

class SwotToTextConverter extends AbstractToText
{
    /** @var ArrayCollection */
    private $cells;

    /** @var array */
    private $listsPositions;

    /** @var array */
    private $listsFactorsPositions;

    public function __construct(Matrix $matrix, array $listsFactorsPositions)
    {
        parent::__construct($matrix);
        $this->cells = $this->matrix->getCells();
        $this->listsPositions = array_keys($listsFactorsPositions);
        $this->listsFactorsPositions = $listsFactorsPositions;
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
