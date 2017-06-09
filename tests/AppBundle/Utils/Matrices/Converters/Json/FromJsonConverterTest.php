<?php

namespace Tests\AppBundle\Utils\Matrices\Converters\Json;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrices\Matrix;
use AppBundle\Utils\Matrices\Converters\Json\FromJsonConverter;

class FromJsonConverterTest extends TestCase
{
    public function testConvert()
    {
        $json = '{"name":"Some name","cells":[{"name":"Cell 1","items":[]},{"name":"Cell 2","items":[{"name":"item 1"},{"name":"item 2"},{"name":""}]}]}';
        $converter = new FromJsonConverter($json);

        $matrix = new Matrix();
        $matrix->setName('Some name');
        $matrix->newCell('Cell 1');
        $matrix->newCell('Cell 2', ['item 1', 'item 2', '']);

        $this->assertSame(
            var_export($matrix, true),
            var_export($converter->convert(), true)
        );
    }

    public function testConvert_wrong()
    {
        $converter = new FromJsonConverter('{"some":"foo"}');

        $this->assertSame(
            var_export(new Matrix(), true),
            var_export($converter->convert(), true)
        );
    }

    /**
     * @expectedException \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    public function testConvert_notValid()
    {
        $converter = new FromJsonConverter('{"name":"Some ndame",""asd}');

        $converter->convert();
    }

    /**
     * @expectedException \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    public function testConvert_empty()
    {
        $converter = new FromJsonConverter('');
        $converter->convert();
    }

    /**
     * @expectedException \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    public function testConvert_php()
    {
        $converter = new FromJsonConverter("<?php echo 'I am a malicious user'; ?>");
        $converter->convert();
    }
}