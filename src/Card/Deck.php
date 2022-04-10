<?php
namespace App\Card;
use App\Card\Card;

class Deck
{
    public $suits = array('Clubs', 'Diamonds', 'Hearts', 'Spades');
    public $values = array('Ace', 2, 3, 4, 5, 6, 7, 8, 9, 10, 'Jack', 'Queen', 'King');
    public $deck = [];

    // method declaration
    public function __construct() {
        foreach($suits as $suit){
            foreach($values as $value){
               array_push($this->$deck, new App/Card/Card($value, $suit));
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