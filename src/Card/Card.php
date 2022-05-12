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

    private function addNames($val){
        $name = "";
        switch ($val) {
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
        }
        return $name;
    }

    // gets the value and suite
    public function getDetails()
    {
        $name = $this->value;
        
        if($name > 10 || $name === 0) {
            $name = $this->addNames($this->value);
        }

        $cardArray = [$this->value,$this->suite,$name];
        return $cardArray;
    }
}
