
Feature: Add
  Scenario: Empty String
    When Input is ""
    Then Add Output is 0

  Scenario: Add 3
    When Input is "1,2"
    Then Add Output is 3

  Scenario Outline: All combinations
    When Input is "<input>"
    Then Add Output is <expected>
    Examples:
    | input | expected|
    |1,2,7  |10       |
    |1,2\\n8  |11       |


