<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Entity\Matrices\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrices\Forms\SwotForm;
use AppBundle\Entity\Matrices\Matrix;
use AppBundle\Entity\Matrices\Cell;
use AppBundle\Entity\Matrices\Item;

abstract class AbstractFromForm
{
    protected $matrixForm = null;
    protected $positions = [];

    function __construct(MatrixFormInterface $matrixForm)
    {
        $this->matrixForm = $matrixForm;
    }

    public function convert(): Matrix
    {
        $matrix = new Matrix();
        $matrix->setName($this->matrixForm->getName());
        foreach ($this->positions as $position) {
            $position = ucfirst($position);
            $getPositionField = 'get'.$position.'Field';
            $getPositionItem = 'get'.$position.'Items';
            $formItems = method_exists(SwotForm::class, $getPositionItem)
                ? $this->matrixForm->$getPositionItem()->getValues() : [];
            $matrix->addCell($this->createCell(
                $this->matrixForm->$getPositionField(),
                $formItems
            ));
        }

        return $matrix;
    }

    private function createCell(string $name, array $formItems): Cell
    {
        $cell = new Cell();
        $cell->setName($name);
        foreach ($formItems as $formItem) {
            if ($formItem->getName() != '') {
                $item = new Item();
                $item->setName($formItem->getName());
                $cell->addItem($item);
            }
        }

        return $cell;
    }
}