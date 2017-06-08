<?php

namespace AppBundle\Utils\Matrices;

use AppBundle\Entity\Matrices\View\MatrixView;
use AppBundle\Entity\Matrices\Form\IMatrixForm;
use AppBundle\Utils\Matrices\Views\SwotView;
use AppBundle\Utils\Matrices\Converters\Text\SwotToTextConverter;
use AppBundle\Utils\Matrices\Converters\Json\ToJsonConverter;
use AppBundle\Utils\Matrices\Converters\Json\FromJsonConverter;
use AppBundle\Utils\Matrices\Converters\Form\SwotFromFormConverter;
use AppBundle\Utils\Matrices\Converters\Form\SwotToFormConverter;

class Swot extends Matrix
{
    public function getView(): MatrixView
    {
        $swotView = new SwotView();

        return $swotView->getView();
    }

    public function getForm(): IMatrixForm
    {
        $converter = new SwotToFormConverter($this->matrixStandard);

        return $converter->convert();
    }

    public function setForm(IMatrixForm $data)
    {
        $converter = new SwotFromFormConverter($data);
        $this->matrixStandard = $converter->convert();

        return $this;
    }

    public function getText(): string
    {
        $converter = new SwotToTextConverter($this->matrixStandard);

        return $converter->convert();
    }

    public function getJson(): string
    {
        $converter = new ToJsonConverter($this->matrixStandard);

        return $converter->convert();
    }


    public function setJson(string $data)
    {
        $converter = new FromJsonConverter($data);
        $this->matrixStandard = $converter->convert();

        return $this;
    }
}