<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Entity\Matrices\Standard\MatrixStandard;
use AppBundle\Entity\Matrices\Form\IMatrixForm;
use AppBundle\Entity\Matrices\Form\FormItem;

abstract class ToForm
{
    protected $matrixStandard = null;
    protected $matrixForm = null;

    function __construct(MatrixStandard $matrixStandard)
    {
        $this->matrixStandard = $matrixStandard;
    }

    public function convert(): IMatrixForm
    {
        $this->matrixForm->setName($this->matrixStandard->getName());
        $i = 0;
        foreach ($this->matrixStandard->getCells() as $cell) {
            $position = ucfirst($this->positions[$i]);
            $getPositionField = 'set'.$position.'Field';
            $getPositionItem = 'get'.$position.'Items';
            $this->matrixForm->$getPositionField($cell->getName());
            if (method_exists(get_class($this->matrixForm), $getPositionItem)) {
                foreach ($cell->getItems() as $item) {
                    $formItem = new FormItem();
                    $this->matrixForm->$getPositionItem()->add($formItem->setName($item->getName()));
                }
            }
            $i++;
        }

        return $this->matrixForm;
    }
}