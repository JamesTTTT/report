<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function card(): Response
    {   

        return $this->render('card.html.twig', [
        ]);
    }

    /**
     * @Route("/card/deck", name="deck")
     */
    public function deck(): Response
    {
        $deck = new \App\Card\Deck();

        return $this->render('deck.html.twig', [
        ]);
    }

    /**
     * @Route("/card/deck/shuffle", name="shuffle")
     */
    public function shuffle(): Response
    {
        return $this->render('shuffle.html.twig', [
        ]);
    }

     /**
     * @Route("/card/deck/draw", name="shuffle")
     */
    public function draw(): Response
    {
        return $this->render('draw.html.twig', [
        ]);
    }

    
}