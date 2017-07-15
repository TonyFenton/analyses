<?php

namespace AppBundle\Entity\Matrix;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use AppBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="matrix")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Matrix\MatrixRepository")
 * @ORM\HasLifecycleCallbacks
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

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Matrix\Type")
     */
    private $type;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $updated;

    public function __construct()
    {
        $this->cells = new ArrayCollection();
    }

    /**
     * Gets triggered only on insert
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime("now");
        $this->updated = new \DateTime("now");
    }

    /**
     * Gets triggered every time on update
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated = new \DateTime("now");
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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

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

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }
}