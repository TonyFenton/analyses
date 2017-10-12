<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        exec('php bin/console cache:clear --no-warmup --env=prod');
        exec('php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/Foo -n');
    }

    /**
     * @Then there are items:
     */
    public function thereAreItems(TableNode $table)
    {
        $page = $this->getSession()->getPage();
        foreach ($table as $row) {
            $value = $page->find(
                'css',
                sprintf('#%s .matrix-items-list li:nth-child(%s) input', $row['cell'], $row['item'] + 1)
            )->getValue();
            assert($row['value'] === $value, sprintf('Expected: "%s", Actual: "%s".', $row['value'], $value));
        }
    }
}
