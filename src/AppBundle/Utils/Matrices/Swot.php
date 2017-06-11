<?php

namespace AppBundle\Utils\Matrices;

use AppBundle\Entity\Matrices\View\MatrixView;
use AppBundle\Entity\Matrices\Forms\MatrixFormInterface;
use AppBundle\Utils\Matrices\Views\SwotView;
use AppBundle\Utils\Matrices\Converters\Text\SwotToTextConverter;
use AppBundle\Utils\Matrices\Converters\Json\ToJsonConverter;
use AppBundle\Utils\Matrices\Converters\Json\FromJsonConverter;
use AppBundle\Utils\Matrices\Converters\Form\SwotFromFormConverter;
use AppBundle\Utils\Matrices\Converters\Form\SwotToFormConverter;

class Swot extends AbstractMatrix
{
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
        $this->matrix = $converter->convert();

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
        $this->matrix = $converter->convert();

        return $this;
    }
}