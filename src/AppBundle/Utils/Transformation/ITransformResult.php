<?php

namespace AppBundle\Utils\Transformation;

use AppBundle\Entity\MatrixForm\IMatrix;

interface ITransformResult
{
    public function transform($data): IMatrix;
}