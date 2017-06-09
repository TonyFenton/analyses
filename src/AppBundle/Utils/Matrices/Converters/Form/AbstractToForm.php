<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Entity\Matrices\Matrix;
use AppBundle\Entity\Matrices\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrices\Forms\ItemForm;

abstract class AbstractToForm
{
    protected $matrix = null;
    protected $matrixForm = null;

    function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }

    public function convert(): MatrixFormInterface
    {
        $this->matrixForm->setName($this->matrix->getName());
        $i = 0;
        foreach ($this->matrix->getCells() as $cell) {
            $position = ucfirst($this->positions[$i]);
            $getPositionField = 'set'.$position.'Field';
            $getPositionItem = 'get'.$position.'Items';
            $this->matrixForm->$getPositionField($cell->getName());
            if (method_exists(get_class($this->matrixForm), $getPositionItem)) {
                foreach ($cell->getItems() as $item) {
                    $formItem = new ItemForm();
                    $this->matrixForm->$getPositionItem()->add($formItem->setName($item->getName()));
                }
            }
            $i++;
        }

        return $this->matrixForm;
    }
}