<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Entity\Matrices\Matrix;
use AppBundle\Entity\Matrices\Forms\SwotForm as MatrixForm;

class SwotToFormConverter extends AbstractToForm
{
    function __construct(Matrix $matrix)
    {
        parent::__construct($matrix);
        $swotForm = new SwotForm();
        $this->positions = $swotForm->getFormPositons();
        $this->matrixForm = new MatrixForm();
    }
}