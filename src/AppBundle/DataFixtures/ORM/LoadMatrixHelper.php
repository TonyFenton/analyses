<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;

abstract class LoadMatrixHelper extends AbstractFixture implements OrderedFixtureInterface
{
    private $matrixRefCounter = 0;
    protected $em = null;

    protected function setMatrix(string $name): LoadMatrixHelper
    {
        $matrix = new MatrixStandard();
        $matrix->setName($name);

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