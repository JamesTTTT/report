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
        $data = [
            'title' => 'Deck',
            'deck' => $deck
        ];

        return $this->render('deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/shuffle", name="shuffle")
     */
    public function shuffle(): Response
    {   
        $deck = new \App\Card\Deck();
        $deck->shuffleDeck();

        $data = [
            'title' => 'deck',
            'deck' => $deck,
        ];
        return $this->render('shuffle.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw", name="draw")
     */
    public function draw(): Response
    {
        $draw = $this->drawCard();
        $data = [
            'draw' => $draw[0],
            'cardsLeft' => $draw[1]
        ];
        return $this->render('draw.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw/{number}", name="draw-number")
     */
    public function drawNumb(int $number): Response
    {   


        return $this->render('draw.html.twig', [
        ]);
    }

    
}