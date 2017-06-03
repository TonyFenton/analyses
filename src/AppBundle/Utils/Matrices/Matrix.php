<?php

namespace AppBundle\Utils\Matrices;

use AppBundle\Entity\Matrices\Form\IMatrixForm;
use  AppBundle\Entity\Matrices\View\MatrixView;
use  AppBundle\Entity\Matrices\Standard\MatrixStandard;

abstract class Matrix
{
    protected $matrixStandard = null;

    abstract public function getView(): MatrixView;

    abstract public function getForm(): IMatrixForm;

    abstract public function setForm(IMatrixForm $data);

    abstract public function setJson(string $data);

    function __construct($data)
    {
        if ($data instanceof IMatrixForm) {
            $this->setForm($data);
        } elseif (!is_null($data)) {
            $this->setJson($data);
        }
    }

    public function getStandard(): MatrixStandard
    {
        return $this->matrixStandard;
    }

    public function setMatrixStandard(MatrixStandard $matrixStandard)
    {
        $this->matrixStandard = $matrixStandard;

        return $this;
    }
}