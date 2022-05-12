<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card", methods={"GET","HEAD"})
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
     * @Route("/card/deck2", name="deck2")
     */
    public function deck2(): Response
    {
        $deck = new \App\Card\Deck2();
        $data = [
            'title' => 'Deck',
            'deck' => $deck
        ];

        return $this->render('deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/shuffle", name="shuffle", methods={"GET","POST"}))
     */
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new \App\Card\Deck();
        $deck->shuffleDeck();

        $session->set('deck', $deck);
        $session->set('cardsLeft', 52);
        $data = [
            'title' => 'shuffle',
            'deck' => $deck,
        ];
        return $this->render('shuffle.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw", name="draw", methods={"GET","POST"}))
     */
    public function draw(SessionInterface $session): Response
    {
        $deck = $session->get("deck") ?? 0;
        $cardCount = $session->get("cardsLeft") ?? 0;
        $draw = $deck->drawCard(1);

        $cardsLeft = $cardCount - 1;

        $session->set('deck', $deck);
        $session->set('cardsLeft', $cardsLeft);
        $data = [
            'title' => 'draw',
            'draw' => $draw,
            'cardsLeft' => $cardsLeft
        ];
        return $this->render('draw.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw/{number}", name="draw-number", methods={"GET","POST"})
     */
    public function drawNumb(SessionInterface $session, int $number): Response
    {
        $deck = $session->get("deck") ?? 0;
        $cardCount = $session->get("cardsLeft") ?? 0;
        $draw = $deck->drawCard($number);

        $cardsLeft = $cardCount - $number;

        $session->set('deck', $deck);
        $session->set('cardsLeft', $cardsLeft);
        $data = [
            'title' => 'draw',
            'draw' => $draw,
            'cardsLeft' => $cardsLeft
        ];
        return $this->render('draw.html.twig', $data);
    }

    /**
     * @Route("/card/deck/deal/{players}/{cards}", name="deal-player", methods={"GET","POST"})
     */
    public function dealPlayer(SessionInterface $session, int $cards, int $players): Response
    {
        $curPlayers = [];
        $cardsLeft = 0;
        foreach (range(1, $players) as $num) {
            $player = new \App\Card\Player();
            $deck = $session->get("deck") ?? 0;
            $cardCount = $session->get("cardsLeft") ?? 0;
            $draw = $deck->drawCard($cards);
            $cardsLeft = $cardCount - $cards;
            $player->dealPlayer($draw);
            $session->set('deck', $deck);
            $session->set('cardsLeft', $cardsLeft);
            array_push($curPlayers, $player);
        }
        $data = [
            'title' => 'player',
            'players' => $curPlayers,
            'cardsleft' => $cardsLeft
        ];

        return $this->render('deal.html.twig', $data);
    }
}
