<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Page\AbstractDescriptionFixtures;

class DescriptionFixtures extends AbstractDescriptionFixtures
{
    protected function setFixtures()
    {
        $loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua';

        $this->setDescription('page_0', 'Swot '.$loremIpsum);
        $this->setDescription('page_1', 'PL Swot '.$loremIpsum);
        $this->setDescription('page_2', 'Homepage '.$loremIpsum);
        $this->setDescription('page_3', 'Upload '.$loremIpsum);
    }
}