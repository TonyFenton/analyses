<?php

namespace Tests\AppBundle\Utils\Matrices\Converters\Form;

use PHPUnit\Framework\TestCase;
use AppBundle\Utils\Matrices\Converters\Form\SwotToFormConverter;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;

class SwotToFormConverterTest extends TestCase
{
    public function testConvert()
    {
        $matrixStandard = $this->getMatrixStandard();
        $converter = new SwotToFormConverter($matrixStandard);
        $swotForm = $converter->convert();

        $this->assertSame($matrixStandard->getName(), $swotForm->getName());
        $this->assertSame($matrixStandard->getCells()[0]->getName(), $swotForm->getA2Field());
        $this->assertSame('Cell 1234', $swotForm->getA3Field());
        $this->assertSame('item 2', $swotForm->getB2Items()->getValues()[1]->getName());
        $this->assertSame('', $swotForm->getC2Field());
        $this->assertCount(4, $swotForm->getB3Items()->getValues());
        $this->assertFalse($swotForm->getC2Items()->next());

    }

    private function getMatrixStandard(): MatrixStandard
    {
        $matrixStandard = new MatrixStandard();
        $matrixStandard->setName('Some name');
        $matrixStandard->newCell('Cell 1');
        $matrixStandard->newCell('Cell 1234');
        $matrixStandard->newCell('Cell 11324');
        $matrixStandard->newCell('Cell 2', ['item 1', 'item 2', '']);
        $matrixStandard->newCell('Cell 368', ['item 1', 'item 2', '', 'Test']);

        return $matrixStandard;
    }
}