<?php

namespace AppBundle\Utils\Matrix\Converters\Form;

use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Entity\Matrix\Forms\SwotForm as MatrixForm;

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