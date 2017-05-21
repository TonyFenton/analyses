<?php

namespace AppBundle\Utils\Matrices\Views;

use  AppBundle\Entity\Matrices\View\MatrixView;

abstract class View
{
    abstract public function getView(): MatrixView;
}