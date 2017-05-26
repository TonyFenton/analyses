<?php

namespace AppBundle\Utils\Matrices\Converters\Json;

use AppBundle\Entity\Matrices\Standard\MatrixStandard;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ToJsonConverter
{
    protected $matrixStandard = null;

    function __construct(MatrixStandard $matrixStandard)
    {
        $this->matrixStandard = $matrixStandard;
    }

    public function convert(): string
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);

        return $serializer->serialize($this->matrixStandard, 'json');
    }

}