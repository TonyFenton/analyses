<?php

namespace AppBundle\Entity\Matrix\View;

class CellView extends AbstractView
{
    private $itemsName = '';
    private $fieldName = '';
    private $isField = true;
    private $isItems = true;

    function __construct()
    {
        $this->addClass('matrix-cell');
    }

    public function getItemsName(): string
    {
        return $this->itemsName;
    }

    public function setItemsName(string $itemsName): CellView
    {
        $this->itemsName = $itemsName;

        return $this;
    }

    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    public function setFieldName(string $fieldName): CellView
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    public function getIsField(): bool
    {
        return $this->isField;
    }

    public function setIsField(bool $isField): CellView
    {
        $this->isField = $isField;

        return $this;
    }

    public function getIsItems(): bool
    {
        return $this->isItems;
    }

    public function setIsItems(bool $isItems): CellView
    {
        $this->isItems = $isItems;

        return $this;
    }
}