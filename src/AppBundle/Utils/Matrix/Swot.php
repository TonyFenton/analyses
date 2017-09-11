<?php

namespace AppBundle\Utils\Matrix;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrix\Cell;
use AppBundle\Entity\Matrix\View\MatrixView;
use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrix\Forms\SwotForm;
use AppBundle\Utils\Matrix\Views\SwotView;
use AppBundle\Utils\Matrix\Converters\Text\SwotToTextConverter;
use AppBundle\Utils\Matrix\Converters\Json\ToJsonConverter;
use AppBundle\Utils\Matrix\Converters\Json\FromJsonConverter;
use AppBundle\Utils\Matrix\Converters\Form\FromFormConverter;
use AppBundle\Utils\Matrix\Converters\Form\ToFormConverter;
use AppBundle\Utils\Matrix\Converters\Html\ToHtmlConverter;

class Swot extends AbstractMatrix
{
    const COLUMNS_QTY = 3;
    const FORM_POSITIONS = [
        'a2',
        'a3',
        'b1',
        'b2',
        'b3',
        'c1',
        'c2',
        'c3',
    ];
    const LISTS_FACTORS_POSITIONS = [
        3 => [0, 2],
        4 => [1, 2],
        6 => [0, 5],
        7 => [1, 5],
    ];

    protected function getTypeName(): string
    {
        return 'swot';
    }

    public function getView(): MatrixView
    {
        $swotView = new SwotView();

        return $swotView->getView();
    }

    public function getForm(): MatrixFormInterface
    {
        $converter = new ToFormConverter($this->matrix, new SwotForm(), self::FORM_POSITIONS);

        return $converter->convert();
    }

    public function setForm(MatrixFormInterface $data)
    {
        $converter = new FromFormConverter($data, self::FORM_POSITIONS);
        $this->setMatrix($converter->convert());

        return $this;
    }

    public function getText(): string
    {
        $converter = new SwotToTextConverter($this->matrix, self::LISTS_FACTORS_POSITIONS);

        return $converter->convert();
    }

    public function getJson(): string
    {
        $converter = new ToJsonConverter($this->matrix);

        return $converter->convert();
    }


    public function setJson(string $data)
    {
        $converter = new FromJsonConverter($data);
        $this->setMatrix($converter->convert());

        return $this;
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

        return (new ToHtmlConverter($this->matrix, $newCells, self::COLUMNS_QTY, $style))->convert();
    }

}
