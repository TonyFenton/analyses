<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Entity\Matrices\Form\IMatrixForm;
use AppBundle\Entity\Matrices\Form\SwotForm;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;
use AppBundle\Entity\Matrices\Standard\StandardCell;
use AppBundle\Entity\Matrices\Standard\StandardItem;

abstract class FromForm
{
    protected $matrixForm = null;
    protected $positions = [];

    function __construct(IMatrixForm $matrixForm)
    {
        $this->matrixForm = $matrixForm;
    }

    public function convert(): MatrixStandard
    {
        $matrixStandard = new MatrixStandard();
        $matrixStandard->setName($this->matrixForm->getName());
        foreach ($this->positions as $position) {
            $position = ucfirst($position);
            $getPositionField = 'get'.$position.'Field';
            $getPositionItem = 'get'.$position.'Items';
            $formItems = method_exists(SwotForm::class, $getPositionItem)
                ? $this->matrixForm->$getPositionItem()->getValues() : [];
            $matrixStandard->addCell($this->createCell(
                $this->matrixForm->$getPositionField(),
                $formItems
            ));
        }

        return $matrixStandard;
    }

    private function createCell(string $name, array $formItems): StandardCell
    {
        $standardCell = new StandardCell();
        $standardCell->setName($name);
        foreach ($formItems as $formItem) {
            if ($formItem->getName() != '') {
                $standardItem = new StandardItem();
                $standardItem->setName($formItem->getName());
                $standardCell->addItem($standardItem);
            }
        }

        return $standardCell;
    }
}