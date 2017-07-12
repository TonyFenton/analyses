<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Matrix\Matrix;

abstract class AbstractMatrixFixtures extends AbstractFixtures
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

    public function getOrder()
    {
        return 30;
    }
}