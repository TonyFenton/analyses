<?php

namespace AppBundle\Utils\Transformation;

use AppBundle\Entity\MatrixForm\IMatrix;
use AppBundle\Entity\MatrixResult\Matrix;

interface ITransformForm
{
    public function transform(IMatrix $data): Matrix;
}