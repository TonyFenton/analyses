<?php

namespace AppBundle\Utils\Matrices\Converters\Json;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use AppBundle\Entity\Matrices\Matrix;

class FromJsonConverter
{
    protected $data = '';

    function __construct(string $data)
    {
        $this->data = $data;
    }

    public function convert(): Matrix
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $serializer = new Serializer([new GetSetMethodNormalizer($classMetadataFactory)], [new JsonEncoder()]);

        return $serializer->deserialize($this->data, Matrix::class, 'json', ['groups' => ['converter']]);
    }
}