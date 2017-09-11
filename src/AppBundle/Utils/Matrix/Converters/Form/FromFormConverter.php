<?php

namespace AppBundle\Utils\Matrix\Converters\Form;

use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Entity\Matrix\Cell;
use AppBundle\Entity\Matrix\Item;

class FromFormConverter
{
    /** @var MatrixFormInterface */
    private $matrixForm;

    /** @var array */
    private $positions;

    function __construct(MatrixFormInterface $matrixForm, array $positions)
    {
        $this->matrixForm = $matrixForm;
        $this->positions = $positions;
    }

    public function convert(): Matrix
    {
        $matrix = new Matrix();
        $matrix->setName($this->matrixForm->getName());
        foreach ($this->positions as $position) {
            $position = ucfirst($position);
            $getPositionField = 'get'.$position.'field';
            $getPositionItem = 'get'.$position.'items';
            $formItems = method_exists($this->matrixForm, $getPositionItem)
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
