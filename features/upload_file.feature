Feature: upload file
  In order to load analysis from file
  As anyone
  I need to upload file

  Scenario: Load SWOT analysis from file
    Given I am on "/swot-analysis/load-from-file"
    When I attach the file "swot.json" to "file_file"
    And I press "Load from file"
    Then I should be on "/swot-analysis"
    And the "swot_name" field should contain "Company XYZ"
    And the "swot_a3field" field should contain "My name for Harmful"
    And there are items:
      | cell    | item | value              |
      | b2-cell | 1    | Great localization |
      | b3-cell | 2    | Tough Clients      |
      | b3-cell | 3    | Lack of expirance  |
      | c2-cell | 1    | Earn lots of money |
    And I should see 2 "#b2-cell .matrix-item" elements
    And I should see 0 "#c3-cell .matrix-item" elements

  Scenario: Upload invalid file (syntax error)
    Given I am on "/swot-analysis/load-from-file"
    When I attach the file "invalid.json" to "file_file"
    And I press "Load from file"
    Then I should be on "/swot-analysis/load-from-file"
    And I should see "Syntax error" in the ".alert" element