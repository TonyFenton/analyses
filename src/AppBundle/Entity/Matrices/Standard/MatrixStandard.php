<?php

namespace AppBundle\Entity\Matrices\Standard;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="matrix")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Matrix\MatrixRepository")
 */
class MatrixStandard
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
     * @ORM\OneToMany(targetEntity="StandardCell", mappedBy="matrix")
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
            $standardCell = new StandardCell();
            $standardCell->setName($cell['name']);
            $standardCell->setItems($cell['items']);
            $this->cells->add($standardCell);
        }

        return $this;
    }

    public function newCell(string $name, array $itemsNames = [])
    {
        $cell = new StandardCell();
        $cell->setName($name);
        foreach ($itemsNames as $itemName) {
            $item = new StandardItem();
            $item->setName($itemName);
            $cell->addItem($item);
        }

        return $this->addCell($cell);
    }

    public function addCell(StandardCell $cell)
    {
        $this->cells->add($cell);

        return $this;
    }

    public function removeCell(StandardCell $cell)
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