<?php

namespace App\Controller;

use App\Entity\Game;
use App\Manager\GameStorageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main', methods: ['GET'])]
    public function index(GameStorageManager $gameStorageManager): Response
    {
        $game = $gameStorageManager->createAndSaveGame();
        return $this->render('index.html.twig', ['game' => $game]);
    }
}