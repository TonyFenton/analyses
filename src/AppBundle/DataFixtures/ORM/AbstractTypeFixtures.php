<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Matrix\Type;

abstract class AbstractTypeFixtures extends AbstractFixtures
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