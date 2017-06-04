<?php

namespace AppBundle\Utils\Matrices;

use AppBundle\Entity\Matrices\Form\IMatrixForm;
use  AppBundle\Entity\Matrices\View\MatrixView;
use  AppBundle\Entity\Matrices\Standard\MatrixStandard;

abstract class Matrix
{
    protected $matrixStandard = null;

    public function getStandard(): MatrixStandard
    {
        return $this->matrixStandard;
    }

    public function setMatrixStandard(MatrixStandard $matrixStandard)
    {
        $this->matrixStandard = $matrixStandard;

        return $this;
    }

    public function getView(): MatrixView
    {
        throw new \BadMethodCallException('exception.not_ready_view');
    }

    public function getForm(): IMatrixForm
    {
        throw new \BadMethodCallException('exception.not_ready_to_form');
    }

    public function setForm(IMatrixForm $data)
    {
        throw new \BadMethodCallException('exception.not_ready_from_form');
    }

    public function getText(): string
    {
        throw new \BadMethodCallException('exception.not_ready_to_text');
    }

    public function setText(string $data)
    {
        throw new \BadMethodCallException('exception.not_ready_from_text');
    }

    public function setJson(string $data)
    {
        throw new \BadMethodCallException('exception.not_ready_from_json');
    }

    public function getJson(): string
    {
        throw new \BadMethodCallException('exception.not_ready_to_json');
    }
}