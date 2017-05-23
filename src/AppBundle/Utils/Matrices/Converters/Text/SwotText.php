<?php

namespace AppBundle\Utils\Matrices\Converters\Text;

use AppBundle\Utils\Matrices\Converters\Swot;

class SwotText extends Swot
{
    private $listsFactorsPositions = [
        3 => [0, 2],
        4 => [1, 2],
        6 => [0, 5],
        7 => [1, 5],
    ];

    public function getListsFactorsPositions(): array
    {
        return $this->listsFactorsPositions;
    }
}