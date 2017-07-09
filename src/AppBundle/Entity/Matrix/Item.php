<?php

namespace AppBundle\Entity\Matrix;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="matrix_item")
 */
class Item
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $name = '';

    /**
     * @ORM\ManyToOne(targetEntity="Cell", inversedBy="items")
     */
    private $cell = null;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @Groups({"converter"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @Groups({"converter"})
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getCell()
    {
        return $this->cell;
    }

    public function setCell(Cell $cell)
    {
        $this->cell = $cell;

        return $this;
    }
}