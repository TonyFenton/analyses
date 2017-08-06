<?php

namespace Tests\AppBundle\Twig;

use PHPUnit\Framework\TestCase;
use AppBundle\Twig\AppExtension;

class AppExtensionTest extends TestCase
{
    private $appExtension = null;

    public function setUp()
    {
        $this->appExtension = new AppExtension();
    }

    public function testCutFilter()
    {
        $this->checkCutFilter(
            'Lorem i...', 'Lorem ipsum dolor sit amet, consectetur adipisci', 10, 'Greater than failed'
        );
        $this->checkCutFilter('Lorem', 'Lorem', 15, 'Less then failed');
        $this->checkCutFilter('Lorem ipsum', 'Lorem ipsum', 11, 'Equal to failed');
        $this->checkCutFilter('Ż...', 'Żółćńüä', 4, 'mb_ failed');
        $this->checkCutFilter('Lorem...', 'Lorem ipsum', 9, 'rtrim failed');
    }

    private function checkCutFilter(string $expected, string $text, int $maxLength, $msg = '')
    {
        $this->assertSame(
            $expected,
            $this->appExtension->cutFilter($text, $maxLength),
            $msg
        );
    }
}