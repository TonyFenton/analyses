<?php

namespace AppBundle\Utils\Matrix;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrix\Cell;
use AppBundle\Entity\Matrix\View\MatrixView;
use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrix\Forms\SwotForm;
use AppBundle\Utils\Matrix\Views\SwotView;
use AppBundle\Utils\Matrix\Converters\Text\SwotToTextConverter;
use AppBundle\Utils\Matrix\Converters\Html\ToHtmlConverter;

class Swot extends AbstractMatrix
{
    protected function getColumnsQty(): int
    {
        return 3;
    }

    protected function getFormPositions(): array
    {
        return [
            'a2',
            'a3',
            'b1',
            'b2',
            'b3',
            'c1',
            'c2',
            'c3',
        ];
    }

    protected function getListsFactorsPositions(): array
    {
        return [
            3 => [0, 2],
            4 => [1, 2],
            6 => [0, 5],
            7 => [1, 5],
        ];
    }

    protected function getTypeName(): string
    {
        return 'swot';
    }

    protected function getMatrixForm(): MatrixFormInterface
    {
        return new SwotForm();
    }

    public function getView(): MatrixView
    {
        $swotView = new SwotView();

        return $swotView->getView();
    }

    public function getText(): string
    {
        $converter = new SwotToTextConverter($this->matrix, $this->getListsFactorsPositions());

        return $converter->convert();
    }

    public function getHtml(): string
    {
        $style = <<<'style'

        .analysis table {
            border-collapse: collapse;
        }
        
        .analysis table, th, td {
            border: 1px solid black;
        }
        
        .analysis td {
            vertical-align: top;
            padding: 8px;
        }
        
        .analysis ul {
            margin-top: 5px;
            margin-bottom: 5px;
            padding-left: 25px;
        }
    
style;
        $style = str_replace("\r", '', $style);

        $cells = $this->matrix->getCells();
        $newCells = new ArrayCollection();
        $newCells->add((new Cell()));
        foreach ($cells as $cell) {
            $newCells->add($cell);
        }

        return (new ToHtmlConverter($this->matrix, $newCells, $this->getColumnsQty(), $style))->convert();
    }
}
