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
     * @When I add a matrix item in :cell cell
     */
    public function iAddAMatrixItemInCell(string $cell)
    {
        $css = sprintf('#%s-cell .add-button', $cell);
        $this->getSession()->getPage()->find('css', $css)->click();
    }

    /**
     * @When I remove :item matrix item in :cell cell
     */
    public function iRemoveMatrixItemInCell(int $item, string $cell)
    {
        $css = sprintf('#%s-cell li:nth-child(%s) .remove-button', $cell, $item + 1);
        $this->getSession()->getPage()->find('css', $css)->click();
        $this->getSession()->wait(200); // hide annimation
    }

    /**
     * @Then there should be items:
     */
    public function thereShouldBeItems(TableNode $table)
    {
        $page = $this->getSession()->getPage();
        foreach ($table as $row) {
            $value = $page->find(
                'css',
                sprintf('#%s-cell .matrix-items-list li:nth-child(%s) input', $row['cell'], $row['item'] + 1)
            )->getValue();
            assert($row['value'] === $value, sprintf('Expected: "%s", Actual: "%s".', $row['value'], $value));
        }
    }
}
