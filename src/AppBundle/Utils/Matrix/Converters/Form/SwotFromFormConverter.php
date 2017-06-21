<?php

namespace AppBundle\Utils\Matrix\Converters\Form;

use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;

class SwotFromFormConverter extends AbstractFromForm
{
    function __construct(MatrixFormInterface $formMatrix)
    {
        parent::__construct($formMatrix);
        $swotForm = new SwotForm();
        $this->positions = $swotForm->getFormPositons();
    }
}