<?php

namespace AppBundle\Utils\Matrix\Views;

use AppBundle\Entity\Matrix\View\MatrixView;

abstract class AbstractView
{
    /**
     * @var MatrixView
     */
    protected $matrix;

    static public function getView(string $type): MatrixView
    {
        if ('swot' === $type) {
            $view = new SwotView();
        } elseif ('pest' === $type) {
            $view = new PestView();
        } else {
            throw new \InvalidArgumentException(sprintf('Unexpected type: "%s"', $type));
        }

        return $view->getMatrixView();
    }

    abstract protected function getMatrixView(): MatrixView;

    public function __construct()
    {
        $this->matrix = new MatrixView();
    }
}
