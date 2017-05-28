<?php

namespace Tests\AppBundle\Utils\Matrices\Converters\Json;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;
use AppBundle\Utils\Matrices\Converters\Json\ToJsonConverter;

class ToJsonConverterTest extends TestCase
{
    private $matrixStandard = null;

    public function setUp()
    {
        $this->matrixStandard = new MatrixStandard();
    }

    public function testConvert()
    {
        $this->matrixStandard->setName('Some name');
        $this->matrixStandard->newCell('Cell 1');
        $this->matrixStandard->newCell('Cell 2', ['item 1', 'item 2', '']);
        $converter = new ToJsonConverter($this->matrixStandard);

        $expected = '{"name":"Some name","cells":[{"name":"Cell 1","items":[]},{"name":"Cell 2","items":[{"name":"item 1"},{"name":"item 2"},{"name":""}]}]}';

        $this->assertSame($expected, $converter->convert());
    }
}