<?php

namespace AppBundle\DataFixtures\ORM\AbstractDataFixtures\Page;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\AbstractDataFixtures;
use AppBundle\Entity\Page\Page;

abstract class AbstractPageFixtures extends AbstractDataFixtures
{
    protected function setPage(string $route, string $title): AbstractPageFixtures
    {
        $page = new Page();
        $page->setRoute($route);
        $page->setTitle($title);

        $this->em->persist($page);
        $this->addReference('page_'.$this->refCounter, $page);
        $this->refCounter++;

        return $this;
    }

    public function getOrder(): int
    {
        return 110;
    }
}