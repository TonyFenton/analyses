<?php

namespace AppBundle\Entity\Matrices;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="matrix")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Matrices\MatrixRepository")
 */
class Matrix
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name = '';

    /**
     * @ORM\OneToMany(targetEntity="Cell", mappedBy="matrix", cascade={"persist", "merge", "remove"})
     */
    private $cells = null;

    private $type;

    public function __construct()
    {
        $this->cells = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
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

    /**
     * @Groups({"converter"})
     */
    public function getCells(): Collection
    {
        return $this->cells;
    }

    /**
     * @Groups({"converter"})
     */
    public function setCells(array $cells)
    {
        foreach ($cells as $cell) {
            $entityCell = new Cell();
            $entityCell->setName($cell['name']);
            $entityCell->setItems($cell['items']);
            $this->addCell($entityCell);
        }

        return $this;
    }

    public function newCell(string $name, array $itemsNames = [])
    {
        $cell = new Cell();
        $cell->setName($name);
        foreach ($itemsNames as $itemName) {
            $item = new Item();
            $item->setName($itemName);
            $cell->addItem($item);
        }

        return $this->addCell($cell);
    }

    public function addCell(Cell $cell)
    {
        $cell->setMatrix($this);
        $this->cells->add($cell);

        return $this;
    }

    public function removeCell(Cell $cell)
    {
        $this->cells->removeElement($cell);

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}