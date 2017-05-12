<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSwotAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/swot');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // some asserts
    }
}
