<?php

declare(strict_types=1);

namespace App\ScoreBoard\Exception;

class ScoreBoardException extends \RuntimeException
{
    public static function gameAlreadyStarted(): self
    {
        return new self('Game already started');
    }

    public static function gameNotStarted(): self
    {
        return new self('Game not started');
    }
}
