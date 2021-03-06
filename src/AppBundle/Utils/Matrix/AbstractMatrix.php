<?php

namespace AppBundle\Utils\Matrix;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Matrix\Forms\MatrixFormInterface;
use AppBundle\Entity\Matrix\View\MatrixView;
use AppBundle\Entity\Matrix\Matrix as MatrixEntity;
use AppBundle\Entity\Matrix\Type;
use AppBundle\Utils\Matrix\Views\AbstractView;
use AppBundle\Utils\Matrix\Converters\Json\ToJsonConverter;
use AppBundle\Utils\Matrix\Converters\Json\FromJsonConverter;
use AppBundle\Utils\Matrix\Converters\Form\FromFormConverter;
use AppBundle\Utils\Matrix\Converters\Form\ToFormConverter;
use AppBundle\Utils\Matrix\Converters\Html\ToHtmlConverter;

abstract class AbstractMatrix
{
    protected $em = null;
    protected $matrix = null;
    protected $type = null;

    abstract protected function getColumnsQty(): int;

    abstract protected function getFormPositions(): array;

    abstract protected function getListsFactorsPositions(): array;

    abstract protected function getMatrixForm(): MatrixFormInterface;

    abstract protected function getTypeName(): string;

    abstract protected function getCells(): ArrayCollection;

    static public function createMatrix(string $type, EntityManagerInterface $em): AbstractMatrix
    {
        if ('swot' === $type) {
            $matrix = new Swot($em);
        } elseif ('pest' === $type) {
            $matrix = new Pest($em);
        } else {
            throw new \InvalidArgumentException(sprintf('Unexpected type: "%s"', $type));
        }

        return $matrix;
    }

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

    public function getType(): Type
    {
        $type = $this->em->getRepository(Type::class)->findOneBy(['name' => $this->getTypeName()]);
        if (!$type) {
            $type = new Type();
            $this->em->persist($type->setName($this->getTypeName()));
        }

        return $this->type = $type;
    }

    public function getView(): MatrixView
    {
        return AbstractView::getView($this->getTypeName());
    }

    public function getForm(): MatrixFormInterface
    {
        $converter = new ToFormConverter($this->matrix, $this->getMatrixForm(), $this->getFormPositions());

        return $converter->convert();
    }

    public function setForm(MatrixFormInterface $data)
    {
        $converter = new FromFormConverter($data, $this->getFormPositions());
        $this->setMatrix($converter->convert());

        return $this;
    }

    public function getJson(): string
    {
        $converter = new ToJsonConverter($this->matrix);

        return $converter->convert();
    }

    public function setJson(string $data)
    {
        $converter = new FromJsonConverter($data);
        $this->setMatrix($converter->convert());

        return $this;
    }

    public function getHtml(): string
    {
        return (new ToHtmlConverter(
            $this->matrix,
            $this->getCells(),
            $this->getColumnsQty(),
            $this->getStyle())
        )->convert();
    }

    protected function getStyle(): string
    {
        $style = <<<'style'

        .analysis table {
            border-collapse: collapse;
            table-layout: fixed;
            min-width: 500px;
        }
        
        .analysis table, th, td {
            border: 1px solid black;
        }
        
        .analysis td {
            vertical-align: top;
            padding: 8px;
        }
        
        .analysis ul {
            margin-top: 5px;
            margin-bottom: 5px;
            padding-left: 25px;
        }
    
style;

        return str_replace("\r", '', $style);
    }
}
