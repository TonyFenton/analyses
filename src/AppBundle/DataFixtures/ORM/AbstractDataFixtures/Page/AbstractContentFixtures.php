<?php

namespace AppBundle\DataFixtures\ORM\AbstractDataFixtures\Page;

use AppBundle\DataFixtures\ORM\AbstractDataFixtures\AbstractDataFixtures;
use AppBundle\Entity\Page\Content;

abstract class AbstractContentFixtures extends AbstractDataFixtures
{
    protected function setContent(string $page, string $header, string $contentText): AbstractContentFixtures
    {
        $content = new Content();
        $content->setHeader($header);
        $content->setContent($contentText);
        $content->setPage($this->getReference($page));
        $this->em->persist($content);

        return $this;
    }

    public function getOrder(): int
    {
        return 120;
    }
}