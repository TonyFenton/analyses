<?php

namespace Tests\AppBundle\Utils\Matrices\Converters\Form;

use PHPUnit\Framework\TestCase;
use AppBundle\Utils\Matrices\Converters\Form\SwotToFormConverter;
use AppBundle\Entity\Matrices\Matrix;

class SwotToFormConverterTest extends TestCase
{
    public function testConvert()
    {
        $matrix = $this->getMatrix();
        $converter = new SwotToFormConverter($matrix);
        $swotForm = $converter->convert();

        $this->assertSame($matrix->getName(), $swotForm->getName());
        $this->assertSame($matrix->getCells()[0]->getName(), $swotForm->getA2Field());
        $this->assertSame('Cell 1234', $swotForm->getA3Field());
        $this->assertSame('item 2', $swotForm->getB2Items()->getValues()[1]->getName());
        $this->assertSame('', $swotForm->getC2Field());
        $this->assertCount(4, $swotForm->getB3Items()->getValues());
        $this->assertFalse($swotForm->getC2Items()->next());

    }

    private function getMatrix(): Matrix
    {
        $matrix = new Matrix();
        $matrix->setName('Some name');
        $matrix->newCell('Cell 1');
        $matrix->newCell('Cell 1234');
        $matrix->newCell('Cell 11324');
        $matrix->newCell('Cell 2', ['item 1', 'item 2', '']);
        $matrix->newCell('Cell 368', ['item 1', 'item 2', '', 'Test']);

        return $matrix;
    }
}