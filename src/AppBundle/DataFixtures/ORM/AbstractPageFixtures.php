<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Page\Page;

abstract class AbstractPageFixtures extends AbstractFixtures
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

    public function getOrder()
    {
        return 110;
    }
}