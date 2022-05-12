<?php

namespace App\Card;

class Game
{
    public $player;
    public $bank;

    public function __construct($player, $bank)
    {
        $this->player = $player;
        $this->bank = $bank;
    }

    private function getVal() {
        $player = $this->player;
        $bank = $this->bank;

        $pval = $player->handValue();
        $bval = $bank->handValue();

        $res = [$pval, $bval];

        return $res;
    }

    /**
     * Compares the scores between the player and bank
     */
    public function compare()
    { 
        $val = $this->getVal();
        $pval = $val[0];
        $bval = $val[1];

        $message = "BUST YOUR BOTH OVER 21";
        if ($pval < 21 && $bval < 21 && $pval > $bval) {
            $message = "BANK LOSE // YOU WIN!!";
        } elseif ($pval < 21 && $bval < 21 && $pval < $bval){
            $message = "YOU LOSE // BANK WINS!!";
        } elseif ($pval > 21 && $bval < 21) {
            $message = "YOUR OVER 21 // BANK WINS!!";
        } elseif ($pval < 21 && $bval > 21) {
            $message = "BANK OVER 21 // YOU WIN!!";
        }
        return $message;
    }
}
