<?php

namespace Tests\AppBundle\Utils\Matrices\Converters\Form;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Matrices\Form\SwotForm;
use AppBundle\Entity\Matrices\Form\FormItem;
use AppBundle\Utils\Matrices\Converters\Form\SwotFromFormConverter;

class SwotFromFormConverterTest extends TestCase
{
    public function testConvert()
    {
        $swotForm = $this->getSwotForm();
        $convert = new SwotFromFormConverter($swotForm);
        $matrixStandard = $convert->convert();

        $this->assertSame($swotForm->getName(), $matrixStandard->getName());
        $this->assertSame($swotForm->getA2Field(), $matrixStandard->getCells()[0]->getName());
        $this->assertSame('', $matrixStandard->getCells()[2]->getName());

        $this->assertEmpty($matrixStandard->getCells()[2]->getItems());
        $this->assertCount(2, $matrixStandard->getCells()[3]->getItems());
        $this->assertSame($swotForm->getB2Items()->get(1)->getName(),
            $matrixStandard->getCells()[3]->getItems()[1]->getName());
        $this->assertCount(3, $matrixStandard->getCells()[7]->getItems());
        $this->assertSame('Tough Clients', $matrixStandard->getCells()[7]->getItems()[1]->getName());
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
        $formItem = new FormItem();
        $formItem->setName($name);
        $parent->add($formItem);
    }
}