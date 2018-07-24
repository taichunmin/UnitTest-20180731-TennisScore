<?php

namespace TennisScore;

class TennisGame
{
    private $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    public function scoreResult(int $gameId)
    {
        return $this->repository->getGame($gameId)->scoreResult();
    }
}
