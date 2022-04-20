<?php

namespace App\Card;

class Player
{
    public $hand = [];

    // public function __construct(){
    //     $this->hand = $hand;
    // }

    public function dealPlayer(array $draw)
    {
        foreach ($draw as $i) {
            array_push($this->hand, $i);
        }
    }

    public function showHand()
    {
        return this->hand;
    }

    public function handValue(){
        $total = 0;
        foreach ($this->hand as $card){
            $total += $card->getDetails()[0];
        }
        return $total;
    }
}
