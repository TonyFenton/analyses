<?php

namespace AppBundle\Utils;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use AppBundle\Entity\Page\Page;

class PageProvider
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var string */
    private $route;

    public function __construct(EntityManagerInterface $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->route = $requestStack->getCurrentRequest()->get('_route');

    }

    /**
     * @return Page|null
     */
    public function getPage()
    {
        return $this->em->getRepository(Page::class)->findOneByRoute($this->route);
    }
}
