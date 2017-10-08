<?php

use PHPUnit\Framework\TestCase;
use Behat\Behat\Context\Context;
use Behat\Mink\Driver\GoutteDriver;
use Behat\Mink\Session;
use Behat\Mink\Element\DocumentElement;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends TestCase implements Context
{
    const DOMAIN = 'http://localhost/swot/web';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var DocumentElement
     */
    private $page;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        parent::__construct();
        exec('php bin/console cache:clear --no-warmup --env=prod');
        exec('php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/Foo -n');
    }

    /**
     * @Given I am on the page :uri
     */
    public function iAmOnThePage(string $uri)
    {
        $driver = new GoutteDriver();
        $this->session = new Session($driver);
        $this->session->start();
        $this->session->visit(self::DOMAIN.$uri);

        $this->page = $this->session->getPage();
    }

    /**
     * @When I click :lang button
     */
    public function iClickPl(string $lang)
    {
        $swiches = $this->page->findById('lang-switches');
        $swiches->findLink($lang)->click();
    }

    /**
     * @Then Now I am on the page :uri
     */
    public function nowIAmOnThePage(string $uri)
    {
        $this->assertSame(self::DOMAIN.$uri, $this->session->getCurrentUrl());
    }

    /**
     * @Given Header is :header
     */
    public function headerIs($header)
    {
        $this->assertSame(
            $this->page->find('css', 'h1')->getText(),
            $header,
            'Wrong header'
        );
    }
}
