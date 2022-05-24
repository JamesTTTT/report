<?php

namespace App\Card;

// use App\Card\Card;

class Deck2 extends Deck
{
    public function __construct()
    {
        parent::__construct();
        array_push($this->deck, new Card(0, 'Joker'));
        array_push($this->deck, new Card(0, 'Joker'));
    }
}
