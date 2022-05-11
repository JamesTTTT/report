<?php

namespace App\Card;

class Card
{
    private int $value;
    private string $suite;

    // Claass constructor for cards
    public function __construct($value, $suite)
    {
        $this->value = $value;
        $this->suite = $suite;
    }

    // gets the value and suite
    public function getDetails()
    {
        switch ($this->value) {
            case 0:
                $name = 'Jk';
                break;
            case 11:
                $name = 'J';
                break;
            case 12:
                $name = 'Q';
                break;
            case 13:
                $name = 'K';
                break;
            case 14:
                $name = 'A';
                break;
            default:
                $name = $this->value;
        }
        $cardArray = [$this->value,$this->suite,$name];
        return $cardArray;
    }
}
