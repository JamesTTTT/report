<?php

namespace App\Card;

//use App\Card\Card;

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

    public function showCards()
    {   
        $cards = [];
        foreach($this->deck as $card){
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
        if ($card_count > 0) {
            for ($x = 1; $x <= $amount; $x++) {
                $cur = array_pop($this->deck);
                array_push($draw, $cur);
            }
        } else {
            $draw = null;
        }
        // $this->card_count = $this->card_count -$amount;
        return $draw;
    }
}

class Deck2J extends Deck
{
    public function __construct()
    {
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                array_push($this->deck, new Card($value, $suit));
            }
        }
        array_push($this->deck, new Card(0, 'Joker', 'Joker'));
        array_push($this->deck, new Card(0, 'Joker', 'Joker'));
    }
}
