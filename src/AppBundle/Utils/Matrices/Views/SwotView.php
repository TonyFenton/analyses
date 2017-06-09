<?php

namespace AppBundle\Utils\Matrices\Views;

use  AppBundle\Entity\Matrices\View\MatrixView;
use  AppBundle\Entity\Matrices\View\RowView;
use  AppBundle\Entity\Matrices\View\CellView;

class SwotView extends AbstractView
{
    public function getView(): MatrixView
    {
        $matrix = new MatrixView();
        $matrix->addClass('swot-matrix');

        $aRow = new RowView();
        $aRow->addClass('hidden-xs hidden-sm');
        $bRow = new RowView();
        $cRow = new RowView();
        $matrix->addRow($aRow)->addRow($bRow)->addRow($cRow);

        $a1Cell = new CellView();
        $a1Cell->setIsField(false)->setIsItems(false)->addClass('col-md-2');
        $a2Cell = new CellView();
        $a2Cell->setIsItems(false)->addClass('col-md-5');
        $a3Cell = new CellView();
        $a3Cell->setIsItems(false)->addClass('col-md-5');
        $aRow->addCell($a1Cell)->addCell($a2Cell)->addCell($a3Cell);

        $b1Cell = new CellView();
        $b1Cell->setIsItems(false)->addClass('hidden-xs hidden-sm col-md-2');
        $b2Cell = new CellView();
        $b2Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $b3Cell = new CellView();
        $b3Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $bRow->addCell($b1Cell)->addCell($b2Cell)->addCell($b3Cell);

        $c1Cell = new CellView();
        $c1Cell->setIsItems(false)->addClass('hidden-xs hidden-sm col-md-2');
        $c2Cell = new CellView();
        $c2Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $c3Cell = new CellView();
        $c3Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $cRow->addCell($c1Cell)->addCell($c2Cell)->addCell($c3Cell);

        return $matrix;
    }
}