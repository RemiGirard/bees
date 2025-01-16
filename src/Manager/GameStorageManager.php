<?php

namespace App\Manager;

use App\Entity\Game;

class GameStorageManager
{
    private GameStorageInterface $gameStorage;
    public function __construct(GameStorageInterface $gameStorage)
    {
        $this->gameStorage = $gameStorage;
    }

    public function getGameOrCreateAndSaveGame(): Game
    {
        $game = $this->gameStorage->getGame();
        if (!$game) {
            $game = new Game();
            $game->populate();
            $this->gameStorage->saveGame($game);
        }

        return $game;
    }
}
