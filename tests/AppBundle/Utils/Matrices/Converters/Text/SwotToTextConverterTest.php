<?php

namespace Tests\AppBundle\Utils\Matrices\Converters\Text;

use PHPUnit\Framework\TestCase;
use AppBundle\Utils\Matrices\Converters\Text\SwotToTextConverter;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;
use AppBundle\Entity\Matrices\Standard\StandardCell;
use AppBundle\Entity\Matrices\Standard\StandardItem;

class SwotToTextConverterTest extends TestCase
{
    private $matrixStandard = null;

    public function setUp()
    {
        $this->matrixStandard = new MatrixStandard();
    }

    public function testConvert()
    {
        $converter = new SwotToTextConverter($this->createMatrixStandard());
        $expected = $this->getExpected();

        $this->assertSame($expected, $converter->convert());
    }

    private function getExpected(): string
    {
        $expected = 'Some name'.PHP_EOL.PHP_EOL;
        $expected .= 'Cell 4 (cell 1):'.PHP_EOL;
        $expected .= '- item 1,'.PHP_EOL;
        $expected .= '- item 2,'.PHP_EOL;
        $expected .= '- item 3.'.PHP_EOL;
        $expected .= 'Cell 5 (łell 2):'.PHP_EOL.PHP_EOL;
        $expected .= 'Cell 7 (cell 1):'.PHP_EOL;
        $expected .= '- Your item.'.PHP_EOL;
        $expected .= '(łell 2):'.PHP_EOL;
        $expected .= '- Your last item.';

        return $expected;
    }

    private function createMatrixStandard(): MatrixStandard
    {
        $this->matrixStandard->setName('Some name');
        $this->createCell('Cell 1');
        $this->createCell('Łell 2');
        $this->createCell('');
        $this->createCell('Cell 4', ['item 1', 'item 2', 'item 3']);
        $this->createCell('Cell 5');
        $this->createCell('');
        $this->createCell('Cell 7', ['Your item']);
        $this->createCell('', ['Your last item']);

        return $this->matrixStandard;
    }

    private function createCell(string $name, array $itemNames = [])
    {
        $cell = new StandardCell();
        $cell->setName($name);
        foreach ($itemNames as $itemName) {
            $item = new StandardItem();
            $item->setName($itemName);
            $cell->addItem($item);
        }
        $this->matrixStandard->addCell($cell);
    }
}