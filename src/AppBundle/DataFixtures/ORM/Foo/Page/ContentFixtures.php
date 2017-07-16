<?php

namespace AppBundle\DataFixtures\ORM\Foo;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\Page\AbstractContentFixtures;

class ContentFixtures extends AbstractContentFixtures
{
    protected function setFixtures()
    {
        $loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';

        $this->setContent('page_0', 'Swot Lorem ipsum dolor sit amet.', 'Swot '.$loremIpsum);
        $this->setContent('page_1', 'PL Swot Lorem ipsum dolor sit amet.', 'PL Swot '.$loremIpsum);
        $this->setContent('page_2', 'Homepage Lorem ipsum dolor sit amet.', 'Homepage '.$loremIpsum);
        $this->setContent('page_3', 'Upload Lorem ipsum dolor sit amet.', 'Upload '.$loremIpsum);
    }
}