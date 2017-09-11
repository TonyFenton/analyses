<?php

namespace Tests\AppBundle\Utils\Matrix\Converters\Text;

use PHPUnit\Framework\TestCase;
use AppBundle\Utils\Matrix\Converters\Text\SwotToTextConverter;
use AppBundle\Entity\Matrix\Matrix;

class SwotToTextConverterTest extends TestCase
{
    /** @var Matrix */
    private $matrix;

    public function setUp()
    {
        $this->matrix = new Matrix();
    }

    public function testConvert()
    {
        $converter = new SwotToTextConverter(
            $this->createMatrix(),
            [
                3 => [0, 2],
                4 => [1, 2],
                6 => [0, 5],
                7 => [1, 5],
            ]
        );
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

    private function createMatrix(): Matrix
    {
        $this->matrix->setName('Some name');
        $this->matrix->newCell('Cell 1');
        $this->matrix->newCell('Łell 2');
        $this->matrix->newCell('');
        $this->matrix->newCell('Cell 4', ['item 1', 'item 2', 'item 3']);
        $this->matrix->newCell('Cell 5');
        $this->matrix->newCell('');
        $this->matrix->newCell('Cell 7', ['Your item']);
        $this->matrix->newCell('', ['Your last item']);

        return $this->matrix;
    }
}
