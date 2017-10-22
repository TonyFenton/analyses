<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PestType extends AbstractMatrixType
{
    protected function getType(): string
    {
        return 'pest';
    }

    public function templateBuildForm()
    {
        $this
            ->addField('a1', 'political')
            ->addItems('a1')
            ->addField('a2', 'economic')
            ->addItems('a2')
            ->addField('b1', 'social')
            ->addItems('b1')
            ->addField('b2', 'technological')
            ->addItems('b2');
    }
}
