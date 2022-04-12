<?php
namespace App\Card;
//use App\Card\Card;

class Deck
{
    // public $suits = ['Clubs', 'Diamonds', 'Hearts', 'Spades'];
    // // 'Jack', 'Queen', 'King'
    // public $values = [14, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
    // public $card_count = 0;
    public $deck = [];

    // method declaration
    public function __construct() {
        $suits = ['Clubs', 'Diamonds', 'Hearts', 'Spades'];
        // 'Jack', 'Queen', 'King'
        $values = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
        foreach($suits as $suit){
            foreach($values as $value){
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

    public function drawCard(int $amount){
        $card_count = count($this->deck);
        $draw = [];
        if ($card_count > 0){
            for($x = 1; $x <= $amount; $x++){
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

class Deck2J extends Deck{
    public function __construct() {
        $suits = ['Clubs', 'Diamonds', 'Hearts', 'Spades'];
        // 'Jack', 'Queen', 'King'
        $values = [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
        foreach($suits as $suit){
            foreach($values as $value){
               array_push($this->deck, new Card($value, $suit));
            }
        }
        array_push($this->deck, new Card(0, 'Joker'));
        array_push($this->deck, new Card(0, 'Joker'));
    }
}
?>