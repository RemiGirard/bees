<?php

namespace App\Manager;

use App\Entity\Game;

interface GameStorageInterface
{
    public function saveGame(Game $game): void;
    public function getGame(): Game | null;
    public function updateGame(Game $game): void;
    public function deleteGame(): void;
}
