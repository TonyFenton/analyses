<?php

namespace AppBundle\Entity\Matrix\View;

class MatrixView extends AbstractView
{
    private $rows = [];
    private $rangeAZ = '';

    function __construct()
    {
        $this->rangeAZ = range('a', 'z');
        $this->id = 'matrix';
    }

    public function addRow(): RowView
    {
        $row = new RowView();
        if (!$row->getId()) {
            $row->setId($this->rangeAZ[count($this->rows)].'-row');
        }
        $this->rows[] = $row;

        return $row;
    }

    public function getRows(): array
    {
        return $this->rows;
    }
}