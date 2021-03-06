<?php

namespace App\Card;

// use App\Card\Card;

class Deck
{
    public $suits = ['♣', '♦', '♥', '♠'];
    public $values = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
    public $deck = [];

    // method declaration
    public function __construct()
    {
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                array_push($this->deck, new Card($value, $suit));
            }
        }
    }

    public function showDeck()
    {
        return $this->deck;
    }

    public function showCardObj()
    {
        $cards = [];
        foreach ($this->deck as $card) {
            array_push($cards, $card);
        }
        return $cards;
    }

    public function showCards()
    {
        $cards = [];
        foreach ($this->deck as $card) {
            array_push($cards, $card->getDetails());
        }
        return $cards;
    }

    public function shuffleDeck()
    {
        shuffle($this->deck);
    }

    public function drawCard(int $amount)
    {
        $card_count = count($this->deck);
        $draw = [];
        if ($card_count > $amount) {
            for ($x = 1; $x <= $amount; $x++) {
                $cur = array_pop($this->deck);
                array_push($draw, $cur);
            }
        }
        // $this->card_count = $this->card_count -$amount;
        return $draw;
    }
}
