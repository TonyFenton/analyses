<?php

namespace AppBundle\Utils\MatrixView;

use AppBundle\Utils\MatrixView\View;
use AppBundle\Utils\MatrixView\Row;

class Matrix extends View
{
    private $rows = [];
    private $rangeAZ = '';

    function __construct()
    {
        $this->rangeAZ = range('a', 'z');
        $this->id = 'matrix';
    }

    public function addRow(Row $row)
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