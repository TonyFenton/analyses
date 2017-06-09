<?php

namespace AppBundle\Utils\Matrices\Converters\Json;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use AppBundle\Entity\Matrices\Matrix;

class ToJsonConverter
{
    protected $matrix = null;

    function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }

    public function convert(): string
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $serializer = new Serializer([new ObjectNormalizer($classMetadataFactory)], [new JsonEncoder()]);

        return $serializer->serialize($this->matrix, 'json', ['groups' => ['converter']]);
    }
}