<?php

namespace TennisScore;

class Game
{
    private const ADVANCE_SCORE_RESULT = 'Adv';

    private const DEUCE = "Deuce";

    private static $scoreLookup = ['Love', 'Fifteen', 'Thirty', 'Forty'];

    public $firstPlayerName;
    public $firstPlayerScore;

    public $secondPlayerName;
    public $secondPlayerScore;
    
    public $id;

    public function scoreResult() : string
    {
        return $this->isDifferentScore()
            ? ($this->isReadyForWin() ? $this->advState() : $this->scoreLookup())
            : ($this->isDeuce() ? self::DEUCE : $this->sameScore());
    }

    private function advPlayer() : string
    {
        return $this->firstPlayerScore > $this->secondPlayerScore
            ? $this->firstPlayerName
            : $this->secondPlayerName;
    }

    private function advScore() : string
    {
        return sprintf("%s %s", $this->advPlayer(), self::ADVANCE_SCORE_RESULT);
    }

    private function advState() : string
    {
        return $this->isAdvance() ? $this->advScore() : $this->winScore();
    }

    private function isAdvance() : bool
    {
        return abs($this->firstPlayerScore - $this->secondPlayerScore) == 1;
    }

    private function isDeuce() : bool
    {
        $isSameScore = !$this->isDifferentScore();

        return $this->firstPlayerScore >= 3 && $isSameScore;
    }

    private function isDifferentScore() : bool
    {
        return $this->firstPlayerScore != $this->secondPlayerScore;
    }

    private function isReadyForWin() : bool
    {
        return $this->firstPlayerScore > 3 || $this->secondPlayerScore > 3;
    }

    private function sameScore() : string
    {
        return sprintf("%s All", self::$scoreLookup[$this->firstPlayerScore]);
    }

    private function scoreLookup() : string
    {
        return sprintf("%s %s", self::$scoreLookup[$this->firstPlayerScore], self::$scoreLookup[$this->secondPlayerScore]);
    }

    private function winScore() : string
    {
        return sprintf("%s Win", $this->advPlayer());
    }
}
