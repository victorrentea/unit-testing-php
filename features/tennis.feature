Feature: Tennis Game

  Scenario: Dragoste
    Given A new game
    Then Score is "Love-Love"

  Scenario: Love Fifteen
    Given A new game
    When Player2 scores one point
    When Player5 scores one point
    Then Score is "Love-Fifteen"

  Scenario: Fifteen Fifteen
    Given A new game
    When Player1 scores one point
    And Player2 scores one point
    Then Score is "Fifteen-Fifteen"

  Scenario: Advantage Player 1
    Given A new game
    When Player1 scores 5 points
    And Player2 scores 4 points
    Then Score is "Advantage Player1"

  Scenario Outline: TOT
    Given A new game
    When Player1 scores <player1Points> points
    And Player2 scores <player2Points> points
    Then Score is "<expectedScore>"

    Examples:
      | player1Points | player2Points | expectedScore     |
      | 7             | 8             | Advantage Player2 |
      | 8             | 6             | Game Won Player1  |
#      | 8             | 10             | Game Won Player2 |

