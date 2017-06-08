<?php

namespace AppBundle\DataFixtures\ORM\FuncionalTest;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\ORM\LoadMatrixHelper;

class LoadMatrixData extends LoadMatrixHelper
{
    public function load(ObjectManager $manager)
    {
        $this->em = $manager;

        $this->setMatrix('Company XYZ');
        $this->setMatrix('Test');

        $this->em->flush();
    }
}