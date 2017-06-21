<?php

namespace Tests\AppBundle\Utils\Matrix\Converters\Json;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Utils\Matrix\Converters\Json\ToJsonConverter;

class ToJsonConverterTest extends TestCase
{
    private $matrix = null;

    public function setUp()
    {
        $this->matrix = new Matrix();
    }

    public function testConvert()
    {
        $this->matrix->setName('Some name');
        $this->matrix->newCell('Cell 1');
        $this->matrix->newCell('Cell 2', ['item 1', 'item 2', '']);
        $converter = new ToJsonConverter($this->matrix);

        $expected = '{"name":"Some name","cells":[{"name":"Cell 1","items":[]},{"name":"Cell 2","items":[{"name":"item 1"},{"name":"item 2"},{"name":""}]}]}';

        $this->assertSame($expected, $converter->convert());
    }
}