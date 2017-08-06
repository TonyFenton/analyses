<?php

namespace AppBundle\Utils\Matrix;

use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrix\View\MatrixView;
use AppBundle\Entity\Matrix\Matrix as MatrixEntity;
use AppBundle\Entity\Matrix\Type;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractMatrix
{
    protected $em = null;
    protected $matrix = null;
    protected $type = null;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getMatrix(): MatrixEntity
    {
        return $this->matrix;
    }

    public function setMatrix(MatrixEntity $matrix): AbstractMatrix
    {
        $this->matrix = $this->type ? $matrix : $matrix->setType($this->getType());

        return $this;
    }

    protected function getType(): Type
    {
        $type = $this->em->getRepository(Type::class)->findOneBy(['name' => $this->getTypeName()]);
        if (!$type) {
            $type = new Type();
            $this->em->persist($type->setName($this->getTypeName()));
        }

        return $this->type = $type;
    }

    abstract protected function getTypeName(): string;

    public function getView(): MatrixView
    {
        throw new \BadMethodCallException('exception.not_ready_view');
    }

    public function getForm(): MatrixFormInterface
    {
        throw new \BadMethodCallException('exception.not_ready_to_form');
    }

    public function setForm(MatrixFormInterface $data)
    {
        throw new \BadMethodCallException('exception.not_ready_from_form');
    }

    public function getText(): string
    {
        throw new \BadMethodCallException('exception.not_ready_to_text');
    }

    public function setText(string $data)
    {
        throw new \BadMethodCallException('exception.not_ready_from_text');
    }

    public function getJson(): string
    {
        throw new \BadMethodCallException('exception.not_ready_to_json');
    }

    public function setJson(string $data)
    {
        throw new \BadMethodCallException('exception.not_ready_from_json');
    }
}