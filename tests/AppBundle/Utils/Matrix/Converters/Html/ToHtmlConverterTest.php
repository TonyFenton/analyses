<?php

namespace Tests\AppBundle\Utils\Matrix\Converters\Html;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;
use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Utils\Matrix\Converters\Html\ToHtmlConverter;

class ToHtmlConverterTest extends TestCase
{
    /** @var Matrix */
    private $matrix;

    public function setUp()
    {
        $this->matrix = new Matrix();
    }

    public function testConvert()
    {
        $matrix = $this->createMatrix();
        $html = (new ToHtmlConverter($matrix, $matrix->getCells(), 2, 'style'))->convert();

        $this->assertTrue($this->isValidXml($html), 'This is not Valid XML');

        $crawler = new Crawler($html);
        $this->assertSame('style', $crawler->filter('style')->text(), 'Wrong style value');
        $this->assertSame('Html test', $crawler->filter('h1')->text(), 'Wrong matrix name');
        $this->assertSame(2, $crawler->filter('tr')->count(), 'Wrong quantity of rows');
        $this->assertSame(4, $crawler->filter('.analysis td')->count(), 'Wrong quantity of cells');
        $this->assertSame('Łell 2', $crawler->filter('td')->filter('span')->eq(1)->text(), 'Wrong cell name');
        $this->assertSame('item óżł b', $crawler->filter('td')->eq(1)->filter('li')->eq(1)->text(), 'Wrong item name');
        $this->assertSame(0, $crawler->filter('td')->eq(2)->filter('li')->count(), 'Wrong quantity of items');
        $this->assertSame(3, $crawler->filter('td')->eq(3)->filter('li')->count(), 'Wrong quantity of items');
    }

    private function createMatrix(): Matrix
    {
        $this->matrix->setName('Html test');
        $this->matrix->newCell('Cell 1');
        $this->matrix->newCell('Łell 2', ['item a', 'item óżł b']);
        $this->matrix->newCell('');
        $this->matrix->newCell('Cell 4', ['item 1', 'item 2', 'item 3']);

        return $this->matrix;
    }

    private function isValidXml(string $xml): bool
    {
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML($xml);

        return empty(libxml_get_errors());
    }
}
