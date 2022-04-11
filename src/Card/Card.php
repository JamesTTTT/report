<?php

namespace App\Card;

class Card
{
    private int $value;
    private string $suite;

    // Claass constructor for cards
    public function __construct($value, $suite){
        $this->value = $value;
        $this->suite = $suite;
    }

    // gets the value and suite
    public function getDetails() {
        $cardArray = [$this->value,$this->suite];
        return $cardArray;
    }

    // public function getValue() {
    //     return $this->value;
    // }

    // public function getSuite() {
    //     return $this->suite;
    // }
}

?>