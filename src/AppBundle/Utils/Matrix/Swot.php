<?php

namespace AppBundle\Utils\Matrix;

use AppBundle\Entity\Matrix\View\MatrixView;
use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Utils\Matrix\Views\SwotView;
use AppBundle\Utils\Matrix\Converters\Text\SwotToTextConverter;
use AppBundle\Utils\Matrix\Converters\Json\ToJsonConverter;
use AppBundle\Utils\Matrix\Converters\Json\FromJsonConverter;
use AppBundle\Utils\Matrix\Converters\Form\SwotFromFormConverter;
use AppBundle\Utils\Matrix\Converters\Form\SwotToFormConverter;

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
}