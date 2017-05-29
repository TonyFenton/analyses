<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Entity\Matrices\Standard\MatrixStandard;
use AppBundle\Entity\Matrices\Form\SwotForm as MatrixForm;

class SwotToFormConverter extends ToForm
{
    function __construct(MatrixStandard $matrixStandard)
    {
        parent::__construct($matrixStandard);
        $swotForm = new SwotForm();
        $this->positions = $swotForm->getFormPositons();
        $this->matrixForm = new MatrixForm();
    }
}