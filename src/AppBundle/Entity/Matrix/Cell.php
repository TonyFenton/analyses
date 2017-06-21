<?php

namespace AppBundle\Entity\Matrix;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="cell")
 */
class Cell
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
    private $name = '';

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="cell", cascade={"persist", "merge", "remove"})
     */
    private $items = null;

    /**
     * @ORM\ManyToOne(targetEntity="Matrix", inversedBy="cells")
     * @ORM\JoinColumn(name="matrix_id", referencedColumnName="id")
     */
    private $matrix = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @Groups({"converter"})
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @Groups({"converter"})
     */
    public function setItems(array $items)
    {
        foreach ($items as $item) {
            $entityItem = new Item();
            $entityItem->setName($item['name']);
            $this->addItem($entityItem);
        }
    }

    public function addItem(Item $item)
    {
        $item->setCell($this);
        $this->items->add($item);

        return $this;
    }

    public function removeItem(Item $item)
    {
        $this->items->removeElement($item);

        return $this;
    }

    public function getMatrix()
    {
        return $this->matrix;
    }

    public function setMatrix(Matrix $matrix)
    {
        $this->matrix = $matrix;

        return $this;
    }
}