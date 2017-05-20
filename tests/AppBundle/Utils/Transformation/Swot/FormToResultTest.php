<?php

namespace Tests\AppBundle\Utils\Swot;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\MatrixForm\Swot;
use AppBundle\Entity\MatrixForm\Item as SwotItem;
use AppBundle\Utils\Transformation\Swot\FormToResult;

class FormToResultTest extends TestCase
{
    public function testTransform()
    {
        $swot = $this->getSwot();
        $formToResult = new FormToResult();
        $matrixResult = $formToResult->transform($swot);

        $this->assertSame($swot->getName(), $matrixResult->getName());
        $this->assertSame($swot->getA2Field(), $matrixResult->getCells()[0]->getName());
        $this->assertSame('', $matrixResult->getCells()[2]->getName());

        $this->assertEmpty($matrixResult->getCells()[2]->getItems());
        $this->assertCount(2, $matrixResult->getCells()[3]->getItems());
        $this->assertSame($swot->getB2Items()->get(1)->getName(), $matrixResult->getCells()[3]->getItems()[1]->getName());
        $this->assertCount(3, $matrixResult->getCells()[7]->getItems());
        $this->assertSame('Tough Clients', $matrixResult->getCells()[7]->getItems()[1]->getName());
    }

    private function getSwot(): Swot
    {
        $swot = new Swot();
        $swot->setName('Company XYZ');
        $swot->setA2Field('');
        $swot->setA3Field('My name for Harmful');

        $this->addItems($swot->getB2Items(), 'Great localization');
        $this->addItems($swot->getB2Items(), 'Good Idea');

        $swot->setC3Field('Threats');

        $this->addItems($swot->getC3Items(), 'Strong competition');
        $this->addItems($swot->getC3Items(), ''); // skip
        $this->addItems($swot->getC3Items(), 'Tough Clients');
        $this->addItems($swot->getC3Items(), 'Lack of expirance');

        return $swot;
    }


    private function addItems(ArrayCollection $parent, string $name)
    {
        $swotItem = new SwotItem();
        $swotItem->setName($name);
        $parent->add($swotItem);
    }
}