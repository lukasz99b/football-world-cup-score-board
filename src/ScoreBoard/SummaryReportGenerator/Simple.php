<?php

declare(strict_types=1);

namespace App\ScoreBoard\SummaryReportGenerator;

use App\ScoreBoard\Game;
use App\ScoreBoard\GameCollection;
use App\ScoreBoard\SummaryReportGenerator;

class Simple implements SummaryReportGenerator
{
    private const TOTAL_SCORE_EQUAL = 0;
    private const RECENT_GAME_FIRST = 1;

    public function generate(GameCollection $games): string
    {
        $data = $this->sortGamesByScore($games->toArray());

        $summary = '';

        foreach ($data as $game) {
            $summary .= sprintf(
                '%s %d - %s %d' . PHP_EOL,
                $game->homeTeamName,
                $game->getHomeTeamScore(),
                $game->awayTeamName,
                $game->getAwayTeamScore(),
            );
        }

        return $summary;
    }

    private function sortGamesByScore(array $games): array
    {
        usort(
            $games,
            function (Game $gameA, Game $gameB) {
                $result = $gameB->getHomeTeamScore() + $gameB->getAwayTeamScore()
                    <=> $gameA->getHomeTeamScore() + $gameA->getAwayTeamScore();

                return $result !== self::TOTAL_SCORE_EQUAL ? $result : self::RECENT_GAME_FIRST;
            }
        );

        return $games;
    }
}
