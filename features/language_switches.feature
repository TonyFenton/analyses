Feature: language switches
  In order to change language
  As anyone
  I click a link

  Scenario: Change language from English to Polish
    Given I am on the page "/swot-analysis?foo=sth"
    And Header is "Swot Lorem ipsum dolor sit amet."
    When I click "pl" button
    Then Now I am on the page "/analiza-swot?foo=sth"
    And Header is "PL Swot Lorem ipsum dolor sit amet."