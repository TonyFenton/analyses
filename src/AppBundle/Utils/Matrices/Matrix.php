<?php

namespace AppBundle\Utils\Matrices;

use AppBundle\Entity\Matrices\Form\IMatrixForm;
use AppBundle\Utils\Matrices\Converters\Form\SwotFromFormConverter;
use  AppBundle\Entity\Matrices\View\MatrixView;

abstract class Matrix
{
    protected $matrixResult = null;

    function __construct($data)
    {
        if ($data instanceof IMatrixForm) {
            $converter = new SwotFromFormConverter($data);
            $this->matrixResult = $converter->convert();
        }
    }

    abstract public function getView(): MatrixView;

    abstract public function getForm(): IMatrixForm;


}