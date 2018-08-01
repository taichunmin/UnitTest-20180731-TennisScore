<?php

namespace Test\TennisScore;

use Mockery as m;
use TennisScore\Game;
use TennisScore\TennisGame;
use TennisScore\IRepository;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class TennisGameTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @test */
    public function love_all()
    {
        $game = $this->makeGame(0, 0);

        $iRepository = m::mock(IRepository::class);
        $iRepository->shouldReceive('getGame')->andReturn($game);

        $tennisGame = new TennisGame($iRepository);
        $this->assertEquals('Love All', $tennisGame->scoreResult(1));
    }

    /** @test */
    public function fifteen_love()
    {
        $game = $this->makeGame(1, 0);

        $iRepository = m::mock(IRepository::class);
        $iRepository->shouldReceive('getGame')->andReturn($game);

        $tennisGame = new TennisGame($iRepository);
        $this->assertEquals('Fifteen Love', $tennisGame->scoreResult(1));
    }

    /** @test */
    public function deuce()
    {
        $game = $this->makeGame(3, 3);

        $iRepository = m::mock(IRepository::class);
        $iRepository->shouldReceive('getGame')->andReturn($game);

        $tennisGame = new TennisGame($iRepository);
        $this->assertEquals('Deuce', $tennisGame->scoreResult(1));
    }

    /** @test */
    public function advantage()
    {
        $game = $this->makeGame(4, 3);

        $iRepository = m::mock(IRepository::class);
        $iRepository->shouldReceive('getGame')->andReturn($game);

        $tennisGame = new TennisGame($iRepository);
        $this->assertEquals('First Adv', $tennisGame->scoreResult(1));
    }

    /** @test */
    public function win()
    {
        $game = $this->makeGame(5, 3);

        $iRepository = m::mock(IRepository::class);
        $iRepository->shouldReceive('getGame')->andReturn($game);

        $tennisGame = new TennisGame($iRepository);
        $this->assertEquals('First Win', $tennisGame->scoreResult(1));
    }

    /** @test */
    public function score_lookup()
    {
        //
    }

    public function makeGame(int $firstPlayerScore, int $secondPlayerScore)
    {
        $game = new Game;
        $game->firstPlayerName = 'First';
        $game->firstPlayerScore = $firstPlayerScore;
        $game->secondPlayerName = 'Second';
        $game->secondPlayerScore = $secondPlayerScore;

        return $game;
    }
}
