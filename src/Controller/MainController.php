<?php

namespace App\Controller;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main', methods: ['GET'])]
    public function index(): Response
    {
        $game = new Game();
        return $this->render('index.html.twig', ['game' => $game]);
    }
}