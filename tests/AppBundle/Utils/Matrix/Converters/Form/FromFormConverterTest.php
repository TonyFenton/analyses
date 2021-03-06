<?php

namespace Tests\AppBundle\Utils\Matrix\Converters\Form;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrix\Forms\SwotForm;
use AppBundle\Entity\Matrix\Forms\ItemForm;
use AppBundle\Utils\Matrix\Converters\Form\FromFormConverter;

class FromFormConverterTest extends TestCase
{
    public function testConvert()
    {
        $swotForm = $this->getSwotForm();
        $convert = new FromFormConverter($swotForm, ['a2', 'a3', 'b1', 'b2', 'b3', 'c1', 'c2', 'c3']);
        $matrix = $convert->convert();

        $this->assertSame($swotForm->getName(), $matrix->getName());
        $this->assertSame($swotForm->getA2Field(), $matrix->getCells()[0]->getName());
        $this->assertSame('', $matrix->getCells()[2]->getName());

        $this->assertEmpty($matrix->getCells()[2]->getItems());
        $this->assertCount(2, $matrix->getCells()[3]->getItems());
        $this->assertSame($swotForm->getB2Items()->get(1)->getName(),
            $matrix->getCells()[3]->getItems()[1]->getName());
        $this->assertCount(3, $matrix->getCells()[7]->getItems());
        $this->assertSame('Tough Clients', $matrix->getCells()[7]->getItems()[1]->getName());
    }

    private function getSwotForm(): SwotForm
    {
        $swotForm = new SwotForm();
        $swotForm->setName('Company XYZ');
        $swotForm->setA2Field('');
        $swotForm->setA3Field('My name for Harmful');

        $this->addItems($swotForm->getB2Items(), 'Great localization');
        $this->addItems($swotForm->getB2Items(), 'Good Idea');

        $swotForm->setC3Field('Threats');

        $this->addItems($swotForm->getC3Items(), 'Strong competition');
        $this->addItems($swotForm->getC3Items(), ''); // to skip
        $this->addItems($swotForm->getC3Items(), 'Tough Clients');
        $this->addItems($swotForm->getC3Items(), 'Lack of expirance');

        return $swotForm;
    }

    private function addItems(ArrayCollection $parent, string $name)
    {
        $formItem = new ItemForm();
        $formItem->setName($name);
        $parent->add($formItem);
    }
}
