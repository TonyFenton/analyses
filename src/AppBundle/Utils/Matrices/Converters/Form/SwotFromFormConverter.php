<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Entity\Matrices\Form\IMatrixForm;

class SwotFromFormConverter extends FromForm
{
    function __construct(IMatrixForm $formMatrix)
    {
        parent::__construct($formMatrix);
        $swotForm = new SwotForm();
        $this->positions = $swotForm->getFormPositons();
    }
}