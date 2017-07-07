<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Page\Content;

abstract class AbstractContentFixtures extends AbstractFixtures
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

    public function getOrder()
    {
        return 120;
    }
}