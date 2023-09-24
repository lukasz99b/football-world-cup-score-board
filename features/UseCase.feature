Feature: Sample library use case

  Scenario:
    Given the following matches were already played:
      | Home team | Away team | Home goals | Away goals |
      | Mexico    | Canada    | 0          | 5          |
      | Spain     | Brazil    | 10         | 2          |
      | Germany   | France    | 2          | 2          |
      | Uruguay   | Italy     | 6          | 6          |
      | Argentina | Australia | 3          | 1          |
    When I ask for the summary report
    Then I should receive
      """
      Uruguay 6 - Italy 6
      Spain 10 - Brazil 2
      Mexico 0 - Canada 5
      Argentina 3 - Australia 1
      Germany 2 - France 2
      """
