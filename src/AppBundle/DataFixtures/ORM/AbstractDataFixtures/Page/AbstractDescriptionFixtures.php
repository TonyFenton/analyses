<?php

namespace AppBundle\DataFixtures\ORM\AbstractDataFixtures\Page;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\AbstractDataFixtures;
use AppBundle\Entity\Page\Description;

abstract class AbstractDescriptionFixtures extends AbstractDataFixtures
{
    protected function setDescription(
        string $page,
        string $descriptionText
    ): AbstractDescriptionFixtures {
        $description = new Description();
        $description->setDescription($descriptionText);
        $description->setPage($this->getReference($page));
        $this->em->persist($description);

        return $this;
    }

    public function getOrder()
    {
        return 130;
    }
}