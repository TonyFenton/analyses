<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

class SwotForm
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