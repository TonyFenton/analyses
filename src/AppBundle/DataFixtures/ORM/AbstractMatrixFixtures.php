<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Matrix\Matrix;

abstract class AbstractMatrixFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    private $matrixRefCounter = 0;
    protected $em = null;

    protected function setMatrix(string $name, string $user): AbstractMatrixFixtures
    {
        $matrix = new Matrix();
        $matrix->setName($name);
        $matrix->setUser($this->getReference($user));

        $this->em->persist($matrix);
        $this->addReference('matrix_'.$this->matrixRefCounter, $matrix);
        $this->matrixRefCounter++;

        return $this;
    }

    public function getOrder()
    {
        return 20;
    }
}