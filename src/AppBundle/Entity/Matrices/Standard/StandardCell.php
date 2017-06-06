<?php

namespace AppBundle\Entity\Matrices\Standard;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="cell")
 */
class StandardCell
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
     * @ORM\ManyToOne(targetEntity="StandardItem")
     */
    private $items = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
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
    public function getItems(): ArrayCollection
    {
        return $this->items;
    }

    /**
     * @Groups({"converter"})
     */
    public function setItems(array $items)
    {
        foreach ($items as $item) {
            $standardItem = new StandardItem();
            $standardItem->setName($item['name']);
            $this->items->add($standardItem);
        }
    }

    public function addItem(StandardItem $item)
    {
        $this->items->add($item);

        return $this;
    }

    public function removeItem(StandardItem $item)
    {
        $this->items->removeElement($item);

        return $this;
    }
}
