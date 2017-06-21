<?php

namespace AppBundle\Utils\Matrix\Converters\Form;

use AppBundle\Utils\Matrix\Converters\AbstractSwot;

class SwotForm extends AbstractSwot
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