<?php

namespace AppBundle\Utils\Matrices\Converters\Form;

use AppBundle\Entity\Matrices\Form\IMatrixForm;
use AppBundle\Entity\Matrices\Form\SwotForm;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;
use AppBundle\Entity\Matrices\Standard\StandardCell;
use AppBundle\Entity\Matrices\Standard\StandardItem;

abstract class FromForm
{
    protected $formMatrix = null;
    protected $positions = [];

    function __construct(IMatrixForm $formMatrix)
    {
        $this->formMatrix = $formMatrix;
    }

    public function convert(): MatrixStandard
    {
        $matrixResult = new MatrixStandard();
        $matrixResult->setName($this->formMatrix->getName());
        foreach ($this->positions as $position) {
            $position = ucfirst($position);
            $getPositionField = 'get'.$position.'Field';
            $getPositionItem = 'get'.$position.'Items';
            $formItems = method_exists(SwotForm::class,
                $getPositionItem) ? $this->formMatrix->$getPositionItem()->getValues() : [];
            $matrixResult->addCell($this->createCell(
                $this->formMatrix->$getPositionField(),
                $formItems
            ));
        }

        return $matrixResult;
    }

    private function createCell(string $name, array $formItems): StandardCell
    {
        $resultCell = new StandardCell();
        $resultCell->setName($name);
        foreach ($formItems as $formItem) {
            if ($formItem->getName() != '') {
                $resultItem = new StandardItem();
                $resultItem->setName($formItem->getName());
                $resultCell->addItem($resultItem);
            }
        }

        return $resultCell;
    }
}