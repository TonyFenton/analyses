<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Utils\Matrices\Converters\Swot;

class SwotForm extends Swot
{
    protected $formPositons = [
        'a2',
        'a3',
        'b1',
        'b2',
        'b3',
        'c1',
        'c2',
        'c3',
    ];

    public function getFormPositons(): array
    {
        return $this->formPositons;
    }
}