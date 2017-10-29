<?php

namespace AppBundle\Utils\Matrix\Views;

use AppBundle\Entity\Matrix\View\MatrixView;

class SwotView extends AbstractView
{
    public function getMatrixView(): MatrixView
    {
        $this->matrix->setName('swot')->addClass('swot-matrix');
        $row = $this->matrix->addRow()->addClass('hidden-xs hidden-sm');
        $row->addCell()->setIsField(false)->setIsItems(false)->addClass('col-md-2');
        $row->addCell()->setIsItems(false)->addClass('col-md-5');
        $row->addCell()->setIsItems(false)->addClass('col-md-5');

        for ($i = 0; $i < 2; $i++) {
            $row = $this->matrix->addRow();
            $row->addCell()->setIsItems(false)->addClass('hidden-xs hidden-sm col-md-2');
            $row->addCell()->addClass('col-xs-12 col-sm-6 col-md-5');
            $row->addCell()->addClass('col-xs-12 col-sm-6 col-md-5');
        }

        return $this->matrix;
    }
}
