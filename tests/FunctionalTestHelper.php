<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FunctionalTestHelper extends WebTestCase
{
    protected $client = null;
    protected $crawler = null;

    function __construct()
    {
        parent::__construct();
        $this->client = static::createClient();
    }

    public function requestGet(string $uri, int $status = 200)
    {
        $this->crawler = $this->client->request('GET', $uri);
        $this->assertEquals($status, $this->client->getResponse()->getStatusCode());
    }

    public function checkElementsQty(int $expected, string $selector)
    {
        $this->assertSame(
            $expected,
            $this->crawler->filter($selector)->count(),
            "Wrong quantity of \"$selector\""
        );
    }

}