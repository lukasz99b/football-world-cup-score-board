# Requirements

Requirements definition - file: `features/UseCase.feature`

```gherkin
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
```

# Usage

ScoreBoard contract (not included in the code)

```php
interface ScoreBoard
{
    public function getGame(): ?Game;
    public function startGame(string $homeTeamName, string $awayTeamName): void;
    public function finishGame(): void;
    public function updateScore(int $homeTeamScore, int $awayTeamScore): void;
    public function getFinishedGamesSummary(): string;
}
```

Example usage:
```php
$scoreBoard = new ScoreBoard(
    new InMemoryRepository(),
    new SummaryReportGenerator\Simple()
);

$scoreBoard->startGame('Mexico', 'Canada');
$scoreBoard->updateScore(0, 5);
$scoreBoard->finishGame();

// ...

echo $scoreBoard->getFinishedGamesSummary();
```

Also check the file: `features/bootstrap/FeatureContext.php`

# Tests:

To install dependencies:

```shell
$ composer install
```

## Acceptance Test:

```shell
$ vendor/bin/behat

...

1 scenario (1 passed)
3 steps (3 passed)
0m0.01s (9.28Mb)

```

## Unit Tests:

```shell
$ vendor/bin/phpspec run

...

3 specs
11 examples (11 passed)
18ms
```

# Code format

Code format standard: PSR-12 (exeptions indicated in `phpcs.xml`)

```shell
$ vendor/bin/phpcs
```
