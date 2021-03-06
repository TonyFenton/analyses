<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Page\AbstractPageFixtures;

class PageFixtures extends AbstractPageFixtures
{
    protected function setFixtures()
    {
        $this->setPage('en_swot', 'Swot Lorem ipsum');
        $this->setPage('pl_swot', 'PL Swot Lorem ipsum');
        $this->setPage('en_homepage', 'Hompepage Lorem ipsum');
        $this->setPage('en_swot_upload', 'Upload swot Lorem ipsum');
        $this->setPage('en_analyses', 'Analyses Lorem ipsum');
        $this->setPage('en_contact', 'Contact Lorem ipsum');
        $this->setPage('en_pest', 'Pest analysis title');
    }
}