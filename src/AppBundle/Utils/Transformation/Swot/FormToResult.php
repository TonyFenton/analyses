<?php

namespace AppBundle\Utils\Transformation\Swot;

use AppBundle\Entity\MatrixResult\Matrix;
use AppBundle\Entity\MatrixResult\Cell;
use AppBundle\Entity\MatrixResult\Item;
use AppBundle\Utils\Transformation\ITransformForm;
use AppBundle\Entity\MatrixForm\IMatrix;
use AppBundle\Entity\MatrixForm\Swot as SwotForm;

class FormToResult extends Swot implements ITransformForm
{
    public function transform(IMatrix $data): Matrix
    {
        $matrix = new Matrix();
        $matrix->setName($data->getName());
        foreach ($this->formSigns as $sign) {
            $sign = ucfirst($sign);
            $getSignField = 'get'.$sign.'Field';
            $getSignItem = 'get'.$sign.'Items';
            $items = method_exists(SwotForm::class, $getSignItem) ? $data->$getSignItem()->getValues() : [];
            $matrix->addCell($this->createCell(
                $data->$getSignField(),
                $items
            ));
        }

        return $matrix;
    }

    private function createCell(string $name, array $items): Cell
    {
        $cell = new Cell();
        $cell->setName($name);
        foreach ($items as $formItem) {
            if ($formItem->getName() != '') {
                $item = new Item();
                $item->setName($formItem->getName());
                $cell->addItem($item);
            }
        }

        return $cell;
    }
}