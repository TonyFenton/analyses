<?php

namespace AppBundle\Utils\Matrix\Converters\Form;

use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrix\Forms\ItemForm;

class ToFormConverter
{
    /** @var Matrix */
    private $matrix;

    /** @var MatrixFormInterface */
    private $matrixForm;

    /** @var array */
    private $positions;

    function __construct(Matrix $matrix, MatrixFormInterface $matrixForm, array $positions)
    {
        $this->matrix = $matrix;
        $this->matrixForm = $matrixForm;
        $this->positions = $positions;
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
