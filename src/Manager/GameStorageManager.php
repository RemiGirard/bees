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

    public function createAndSaveGame(): Game
    {
        $game = new Game();
        $this->gameStorage->saveGame($game);

        return $game;
    }
}
