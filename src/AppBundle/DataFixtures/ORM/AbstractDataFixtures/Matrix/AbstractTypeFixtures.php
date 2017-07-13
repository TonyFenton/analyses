<?php

namespace AppBundle\DataFixtures\ORM\AbstractDataFixtures\Matrix;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\AbstractDataFixtures;
use AppBundle\Entity\Matrix\Type;

abstract class AbstractTypeFixtures extends AbstractDataFixtures
{
    protected function setType(string $name): AbstractTypeFixtures
    {
        $type = new Type();
        $type->setName($name);

        $this->em->persist($type);
        $this->addReference('type_'.$this->refCounter, $type);
        $this->refCounter++;

        return $this;
    }

    public function getOrder()
    {
        return 20;
    }
}