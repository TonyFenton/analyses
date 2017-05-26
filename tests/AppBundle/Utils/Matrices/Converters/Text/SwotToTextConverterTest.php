<?php

namespace Tests\AppBundle\Utils\Matrices\Converters\Text;

use PHPUnit\Framework\TestCase;
use AppBundle\Utils\Matrices\Converters\Text\SwotToTextConverter;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;

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
        $this->matrixStandard->newCell('Cell 1');
        $this->matrixStandard->newCell('Łell 2');
        $this->matrixStandard->newCell('');
        $this->matrixStandard->newCell('Cell 4', ['item 1', 'item 2', 'item 3']);
        $this->matrixStandard->newCell('Cell 5');
        $this->matrixStandard->newCell('');
        $this->matrixStandard->newCell('Cell 7', ['Your item']);
        $this->matrixStandard->newCell('', ['Your last item']);

        return $this->matrixStandard;
    }
}