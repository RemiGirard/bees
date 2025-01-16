<?php

namespace App\Manager;

use App\Entity\Game;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

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

    public function getGame(): Game
    {
        $game = $this->gameStorage->getGame();
        if (!$game) {
            throw new InvalidConfigurationException('Game not found');
        }
        return $game;
    }

    public function updateGame(Game $game): void
    {
        $this->gameStorage->updateGame($game);
    }

    public function deleteGame(): void
    {
        $this->gameStorage->deleteGame();
    }
}
