<?php

namespace AppBundle\Utils\Matrices\Views;

use AppBundle\Entity\Matrices\View\MatrixView;

abstract class AbstractView
{
    abstract public function getView(): MatrixView;
}