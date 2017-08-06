<?php

namespace AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\AbstractDataFixtures;
use AppBundle\Entity\Matrix\Matrix;

abstract class AbstractMatrixFixtures extends AbstractDataFixtures
{
    protected function setMatrix(string $typeReference, string $name, string $user): AbstractMatrixFixtures
    {
        $matrix = new Matrix();
        $matrix->setName($name);
        $matrix->setUser($this->getReference($user));
        $matrix->setType($this->getReference($typeReference));

        $this->em->persist($matrix);
        $this->addReference('matrix_'.$this->refCounter, $matrix);
        $this->refCounter++;

        return $this;
    }

    public function getOrder(): int
    {
        return 30;
    }
}