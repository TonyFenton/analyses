<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Page\Description;

abstract class AbstractDescriptionFixtures extends AbstractFixtures
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