<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SwotType extends AbstractMatrixType
{
    protected function getType(): string
    {
        return 'swot';
    }

    public function templateBuildForm()
    {
        $this->builder
            ->add('theme', ChoiceType::class, [
                'choices' => [
                    'theme.classic' => 'classic-theme matrix-borders',
                    'theme.classic_without_borders' => 'classic-theme',
                    'theme.gentle' => 'gentle-theme matrix-borders',
                    'theme.paper_sheet' => 'paper-sheet-theme matrix-borders',
                ],
                'label' => 'matrix.theme',
            ])
            ->add('text', SubmitType::class, [
                'label' => 'button.text',
                'attr' => ['class' => 'btn btn-default'],
            ])
            ->add('html', SubmitType::class, [
                'label' => 'button.html',
                'attr' => ['class' => 'btn btn-default'],
            ]);

        $this
            ->addField('a2', 'helpful')
            ->addField('a3', 'harmful')
            ->addField('b1', 'internal')
            ->addField('b2', 'strengths')
            ->addItems('b2')
            ->addField('b3', 'weaknesses')
            ->addItems('b3')
            ->addField('c1', 'external')
            ->addField('c2', 'opportunities')
            ->addItems('c2')
            ->addField('c3', 'threats')
            ->addItems('c3');
    }
}
