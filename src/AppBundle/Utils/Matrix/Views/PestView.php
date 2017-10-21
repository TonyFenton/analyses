<?php

namespace AppBundle\Utils\Matrix\Views;

use  AppBundle\Entity\Matrix\View\MatrixView;
use  AppBundle\Entity\Matrix\View\RowView;
use  AppBundle\Entity\Matrix\View\CellView;

class PestView extends AbstractView
{
    public function getView(): MatrixView
    {
        $matrix = new MatrixView();
        $matrix->setName('pest');
        $matrix->addClass('pest-matrix');

        $aRow = new RowView();
        $bRow = new RowView();
        $matrix->addRow($aRow)->addRow($bRow);

        $a1Cell = new CellView();
        $a1Cell->addClass('col-xs-12 col-sm-6');
        $a2Cell = (new CellView());
        $a2Cell->addClass('col-xs-12 col-sm-6');
        $aRow->addCell($a1Cell)->addCell($a2Cell);

        $b1Cell = new CellView();
        $b1Cell->addClass('col-xs-12 col-sm-6');
        $b2Cell = (new CellView());
        $b2Cell->addClass('col-xs-12 col-sm-6');
        $bRow->addCell($b1Cell)->addCell($b2Cell);

        return $matrix;
    }
}
