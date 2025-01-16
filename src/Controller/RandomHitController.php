<?php

namespace App\Controller;

use App\Manager\GameStorageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class RandomHitController extends AbstractController
{
    #[Route('/random_hit', name: 'random_hit', methods: ['POST'])]
    public function index(GameStorageManager $gameStorageManager): RedirectResponse
    {
        $game = $gameStorageManager->getGame();

        $game->hitRandomBee();
        $game->procGameOverIfNeeded();

        $gameStorageManager->updateGame($game);

        return $this->redirectToRoute('main');
    }
}