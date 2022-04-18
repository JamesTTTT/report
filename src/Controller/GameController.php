<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function game(): Response
    {
        return $this->render('game.html.twig', [
        ]);
    }
    /**
     * @Route("/game/play", name="play")
     */
    public function play(): Response
    {
        return $this->render('play.html.twig', [
        ]);
    }
}
