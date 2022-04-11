<?php
namespace App\Card;
//use App\Card\Card;

class Deck
{
    public $suits = ['Clubs', 'Diamonds', 'Hearts', 'Spades'];
    // 'Jack', 'Queen', 'King'
    public $values = [14, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
    public $deck = [];

    // method declaration
    public function __construct() {
        foreach($this->suits as $suit){
            foreach($this->values as $value){
               array_push($this->deck, new Card($value, $suit));
            }
        }
    }

    public function showDeck() {
        return $this->deck;
    }

    public function shuffleDeck() {
        shuffle($this->deck);
    }

    public function drawCard(){
        $card_count = count($this->deck);
        if ($card_count > 0){
            $draw = array_pop($this->deck);
        } else {
            $draw = null;
        }
        $card_count = $card_count -1;
        return [$draw, $card_count];
    }
}
?>