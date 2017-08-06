<?php

namespace AppBundle\Entity\Page;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Entity
 * @ORM\Table(name="page")
 */
class Page
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=100, unique=true)
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToOne(targetEntity="Content", mappedBy="page")
     */
    private $content;

    /**
     * @ORM\OneToOne(targetEntity="Description", mappedBy="page")
     */
    private $description;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return Page
     */
    public function setRoute($route): Page
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Page
     */
    public function setTitle($title): Page
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param \AppBundle\Entity\Page\Content $content
     *
     * @return Page
     */
    public function setContent(Content $content = null): Page
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return \AppBundle\Entity\Page\Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set description
     *
     * @param \AppBundle\Entity\Page\Description $description
     *
     * @return Page
     */
    public function setDescription(Description $description = null): Page
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return \AppBundle\Entity\Page\Description
     */
    public function getDescription()
    {
        return $this->description;
    }
}