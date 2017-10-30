<?php

namespace AppBundle\Utils\Matrix;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrix\Forms\PestForm;

class Pest extends AbstractMatrix
{
    protected function getColumnsQty(): int
    {
        return 2;
    }

    protected function getFormPositions(): array
    {
        return [
            'a1',
            'a2',
            'b1',
            'b2',
        ];
    }

    protected function getListsFactorsPositions(): array
    {
        return [
            3 => [0, 2],
            4 => [1, 2],
            6 => [0, 5],
            7 => [1, 5],
        ];
    }

    protected function getTypeName(): string
    {
        return 'pest';
    }

    protected function getMatrixForm(): MatrixFormInterface
    {
        return new PestForm();
    }

    protected function getCells(): ArrayCollection
    {
        return $this->matrix->getCells();
    }
}
