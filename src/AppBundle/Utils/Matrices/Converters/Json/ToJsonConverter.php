<?php

namespace AppBundle\Utils\Matrices\Converters\Json;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;

class ToJsonConverter
{
    protected $matrixStandard = null;

    function __construct(MatrixStandard $matrixStandard)
    {
        $this->matrixStandard = $matrixStandard;
    }

    public function convert(): string
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $serializer = new Serializer([new ObjectNormalizer($classMetadataFactory)], [new JsonEncoder()]);

        return $serializer->serialize($this->matrixStandard, 'json', ['groups' => ['converter']]);
    }
}