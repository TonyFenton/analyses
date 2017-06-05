<?php

namespace AppBundle\Utils\Matrices\Views;

use  AppBundle\Entity\Matrices\View\MatrixView;
use  AppBundle\Entity\Matrices\View\ViewRow;
use  AppBundle\Entity\Matrices\View\ViewCell;

class SwotView extends View
{
    public function getView(): MatrixView
    {
        $matrix = new MatrixView();
        $matrix->addClass('swot-matrix');

        $aRow = new ViewRow();
        $aRow->addClass('hidden-xs hidden-sm');
        $bRow = new ViewRow();
        $cRow = new ViewRow();
        $matrix->addRow($aRow)->addRow($bRow)->addRow($cRow);

        $a1Cell = new ViewCell();
        $a1Cell->setIsField(false)->setIsItems(false)->addClass('col-md-2');
        $a2Cell = new ViewCell();
        $a2Cell->setIsItems(false)->addClass('col-md-5');
        $a3Cell = new ViewCell();
        $a3Cell->setIsItems(false)->addClass('col-md-5');
        $aRow->addCell($a1Cell)->addCell($a2Cell)->addCell($a3Cell);

        $b1Cell = new ViewCell();
        $b1Cell->setIsItems(false)->addClass('hidden-xs hidden-sm col-md-2');
        $b2Cell = new ViewCell();
        $b2Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $b3Cell = new ViewCell();
        $b3Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $bRow->addCell($b1Cell)->addCell($b2Cell)->addCell($b3Cell);

        $c1Cell = new ViewCell();
        $c1Cell->setIsItems(false)->addClass('hidden-xs hidden-sm col-md-2');
        $c2Cell = new ViewCell();
        $c2Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $c3Cell = new ViewCell();
        $c3Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $cRow->addCell($c1Cell)->addCell($c2Cell)->addCell($c3Cell);

        return $matrix;
    }
}
