<?php

namespace AppBundle\Utils\Matrix\Views;

use AppBundle\Entity\Matrix\View\MatrixView;

class PestView extends AbstractView
{
    public function getMatrixView(): MatrixView
    {
        $this->matrix->setName('pest')->addClass('pest-matrix');
        for ($i = 0; $i < 2; $i++) {
            $row = $this->matrix->addRow();
            $row->addCell()->addClass('col-xs-12 col-sm-6');
            $row->addCell()->addClass('col-xs-12 col-sm-6');
        }

        return $this->matrix;
    }
}
