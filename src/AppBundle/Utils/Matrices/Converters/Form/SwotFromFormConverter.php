<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Entity\Matrices\Forms\MatrixFormInterface;

class SwotFromFormConverter extends AbstractFromForm
{
    function __construct(MatrixFormInterface $formMatrix)
    {
        parent::__construct($formMatrix);
        $swotForm = new SwotForm();
        $this->positions = $swotForm->getFormPositons();
    }
}