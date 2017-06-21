<?php

namespace AppBundle\Utils\Matrix\Converters\Form;

use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrix\Forms\SwotForm;
use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Entity\Matrix\Cell;
use AppBundle\Entity\Matrix\Item;

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