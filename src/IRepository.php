<?php

namespace TennisScore;

interface IRepository
{
    public function getGame(int $gameId) : Game;
}
