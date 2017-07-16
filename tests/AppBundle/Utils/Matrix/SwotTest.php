<?php

namespace Tests\AppBundle\Utils\Matrix;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Matrix\Type;
use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Utils\Matrix\Swot;

class SwotTest extends TestCase
{
    private $swot;

    public function testSetMatrix_new()
    {
        $this->swot = new Swot($this->getEmMock());
        $this->checkMatrixType('swot');
    }

    public function testSetMatrix_exists()
    {
        $expectedTypeName = 'TesT';
        $type = new Type();
        $type->setName($expectedTypeName);

        $this->swot = new Swot($this->getEmMock($type));
        $this->checkMatrixType($expectedTypeName);
    }

    private function getEmMock($type = null): EntityManager
    {
        $ob = $this->createMock(ObjectRepository::class);
        $ob->method('findOneBy')->willReturn($type);

        $em = $this->createMock(EntityManager::class);
        $em->method('getRepository')->willReturn($ob);
        $em->method('persist')->will($this->returnSelf());

        return $em;
    }

    private function checkMatrixType(string $expectedTypeName)
    {
        $typeName = $this->swot->setMatrix(new Matrix)->getMatrix()->getType()->getName();
        $this->assertSame($expectedTypeName, $typeName, 'Wrong Type name');
    }
}