<?php

namespace AppBundle\Utils\Matrices;

use AppBundle\Utils\Matrices\Views\SwotView;
use  AppBundle\Entity\Matrices\View\MatrixView;
use AppBundle\Entity\Matrices\Form\IMatrixForm;
use AppBundle\Entity\Matrices\Form\SwotForm;

class Swot extends Matrix
{
    public function getView(): MatrixView
    {
        $swotView = new SwotView();

        return $swotView->getView();
    }

    public function getForm(): IMatrixForm
    {
        // TODO: Implement getForm() method.
        return new SwotForm();
    }

    //    public function getText(): string
    //    {
    //
    //    }

}