<?php

namespace AppBundle\Utils\Matrix;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrix\Cell;
use AppBundle\Entity\Matrix\View\MatrixView;
use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Utils\Matrix\Views\SwotView;
use AppBundle\Utils\Matrix\Converters\Text\SwotToTextConverter;
use AppBundle\Utils\Matrix\Converters\Json\ToJsonConverter;
use AppBundle\Utils\Matrix\Converters\Json\FromJsonConverter;
use AppBundle\Utils\Matrix\Converters\Form\SwotFromFormConverter;
use AppBundle\Utils\Matrix\Converters\Form\SwotToFormConverter;
use AppBundle\Utils\Matrix\Converters\Html\ToHtmlConverter;

class Swot extends AbstractMatrix
{
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
        $converter = new SwotToFormConverter($this->matrix);

        return $converter->convert();
    }

    public function setForm(MatrixFormInterface $data)
    {
        $converter = new SwotFromFormConverter($data);
        $this->setMatrix($converter->convert());

        return $this;
    }

    public function getText(): string
    {
        $converter = new SwotToTextConverter($this->matrix);

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

        return (new ToHtmlConverter($this->matrix, $newCells, 3, $style))->convert();
    }

}
