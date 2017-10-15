Feature: matrix items
  In order to fill in matrix
  As anyone
  I need to manage items

  @javascript
  Scenario: Add and remove items
    Given I am on "/swot-analysis"
    When I add a matrix item in "b2" cell
    And I add a matrix item in "c3" cell
    And I add a matrix item in "c3" cell
    And I add a matrix item in "b2" cell
    And I remove 1 matrix item in "c3" cell
    And I add a matrix item in "b2" cell
    And I add a matrix item in "b3" cell
    And I remove 2 matrix item in "b2" cell
    And I remove 1 matrix item in "b3" cell
    Then I should see 2 "#b2-cell .matrix-item" elements
    Then I should see 1 "#c3-cell .matrix-item" elements
    Then I should see 0 "#b3-cell .matrix-item" elements