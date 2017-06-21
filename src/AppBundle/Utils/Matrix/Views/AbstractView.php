<?php

namespace AppBundle\Utils\Matrix\Views;

use AppBundle\Entity\Matrix\View\MatrixView;

abstract class AbstractView
{
    abstract public function getView(): MatrixView;
}