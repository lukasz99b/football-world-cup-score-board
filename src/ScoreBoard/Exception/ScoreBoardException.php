<?php

namespace App\ScoreBoard\Exception;

class ScoreBoardException extends \RuntimeException
{
    public static function gameAlreadyStarted(): self
    {
        return new self('Game already started');
    }
}
