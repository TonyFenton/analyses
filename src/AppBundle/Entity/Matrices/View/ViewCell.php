<?php

namespace AppBundle\Entity\Matrices\View;

class ViewCell extends View
{
    private $itemsName = '';
    private $fieldName = '';
    private $isField = true;
    private $isItems = true;

    function __construct()
    {
        $this->addClass('cell');
    }

    public function getItemsName(): string
    {
        return $this->itemsName;
    }

    public function setItemsName(string $itemsName)
    {
        $this->itemsName = $itemsName;

        return $this;
    }

    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    public function setFieldName(string $fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    public function getIsField(): bool
    {
        return $this->isField;
    }

    public function setIsField(bool $isField)
    {
        $this->isField = $isField;

        return $this;
    }

    public function getIsItems(): bool
    {
        return $this->isItems;
    }

    public function setIsItems(bool $isItems)
    {
        $this->isItems = $isItems;

        return $this;
    }
}