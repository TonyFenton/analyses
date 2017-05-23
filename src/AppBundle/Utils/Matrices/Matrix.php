<?php

namespace AppBundle\Utils\Matrices;

use AppBundle\Entity\Matrices\Form\IMatrixForm;
use AppBundle\Utils\Matrices\Converters\Form\SwotFromFormConverter;
use  AppBundle\Entity\Matrices\View\MatrixView;
use  AppBundle\Entity\Matrices\Standard\MatrixStandard;

abstract class Matrix
{
    protected $matrixStandard = null;

    abstract public function getView(): MatrixView;

    abstract public function getForm(): IMatrixForm;

    function __construct($data)
    {
        if ($data instanceof IMatrixForm) {
            $converter = new SwotFromFormConverter($data);
            $this->matrixStandard = $converter->convert();
        }
    }

    public function getStandard(): MatrixStandard
    {
        return $this->matrixStandard;
    }

}