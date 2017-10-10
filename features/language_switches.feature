Feature: language switches
  In order to change language
  As anyone
  I click a link

  Scenario: Change language
    Given I am on "/swot-analysis?foo=sth"
    And I should see "Swot Lorem ipsum dolor sit amet." in the "h1" element
    When I follow "pl"
    Then I should be on "/analiza-swot?foo=sth"
    And I should see "PL Swot Lorem ipsum dolor sit amet." in the "h1" element