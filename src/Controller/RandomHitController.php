<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class RandomHitController extends AbstractController
{
    #[Route('/random_hit', name: 'random_hit', methods: ['POST'])]
    public function index(): RedirectResponse
    {
        // TODO: add action
        return $this->redirectToRoute('main');
    }
}