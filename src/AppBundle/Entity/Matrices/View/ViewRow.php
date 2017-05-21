<?php

namespace AppBundle\Entity\Matrices\View;

class ViewRow extends View
{
    private $cells = [];

    function __construct()
    {
        $this->class = 'row';
    }

    public function addCell(ViewCell $cell)
    {
        $prefix = str_replace('-row', '', $this->id) . (count($this->cells) + 1);
        if (!$cell->getId()) {
            $cell->setId($prefix . '-cell');
        }
        if (!$cell->getFieldName() && $cell->getIsField()) {
            $cell->setFieldName($prefix . '_field');
        }
        if (!$cell->getItemsName() && $cell->getIsItems()) {
            $cell->setItemsName($prefix . '_items');
        }

        $this->cells[] = $cell;

        return $this;
    }

    public function getCells(): array
    {
        return $this->cells;
    }


}