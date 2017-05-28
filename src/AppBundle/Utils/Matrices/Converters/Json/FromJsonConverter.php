<?php

namespace AppBundle\Utils\Matrices\Converters\Json;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;

class FromJsonConverter
{
    protected $data = '';

    function __construct(string $data)
    {
        $this->data = $data;
    }

    public function convert(): MatrixStandard
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $matrixStandard = $serializer->deserialize($this->data, MatrixStandard::class, 'json');

        return $matrixStandard;
    }
}