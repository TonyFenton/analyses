<?php

namespace AppBundle\Entity\Matrices\View;

class MatrixView extends View
{
    private $rows = [];
    private $rangeAZ = '';

    function __construct()
    {
        $this->rangeAZ = range('a', 'z');
        $this->id = 'matrix';
    }

    public function addRow(ViewRow $row)
    {
        if (!$row->getId()) {
            $row->setId($this->rangeAZ[count($this->rows)] . '-row');
        }
        $this->rows[] = $row;

        return $this;
    }

    public function getRows(): array
    {
        return $this->rows;
    }


}