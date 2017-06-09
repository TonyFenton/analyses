<?php

namespace AppBundle\Utils\Matrices;

use AppBundle\Entity\Matrices\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrices\View\MatrixView;
use AppBundle\Entity\Matrices\Matrix as MatrixEntity;

abstract class AbstractMatrix
{
    protected $matrix = null;

    public function getMatrix(): MatrixEntity
    {
        return $this->matrix;
    }

    public function setMatrix(MatrixEntity $matrix)
    {
        $this->matrix = $matrix;

        return $this;
    }

    public function getView(): MatrixView
    {
        throw new \BadMethodCallException('exception.not_ready_view');
    }

    public function getForm(): MatrixFormInterface
    {
        throw new \BadMethodCallException('exception.not_ready_to_form');
    }

    public function setForm(MatrixFormInterface $data)
    {
        throw new \BadMethodCallException('exception.not_ready_from_form');
    }

    public function getText(): string
    {
        throw new \BadMethodCallException('exception.not_ready_to_text');
    }

    public function setText(string $data)
    {
        throw new \BadMethodCallException('exception.not_ready_from_text');
    }

    public function getJson(): string
    {
        throw new \BadMethodCallException('exception.not_ready_to_json');
    }

    public function setJson(string $data)
    {
        throw new \BadMethodCallException('exception.not_ready_from_json');
    }
}