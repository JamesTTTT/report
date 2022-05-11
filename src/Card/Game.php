<?php

namespace App\Card;

class Game
{
    public $player;
    public $bank;

    public function __construct($you, $thebank)
    {
        $this->player = $you;
        $this->bank = $thebank;
    }

    public function compare()
    {
        $p = $this->player;
        $b = $this->bank;

        $pval = $p->handValue();
        $bval = $b->handValue();

        if ($pval < 21 && $bval < 21) {
            if ($pval > $bval) {
                $message = "BANK LOSE // YOU WIN!!";
            }
            $message = "YOU LOSE // BANK WINS!!";
        } elseif ($pval > 21 && $bval < 21) {
            $message = "YOUR OVER 21 // BANK WINS!!";
        } elseif ($pval < 21 && $bval > 21) {
            $message = "BANK OVER 21 // YOU WIN!!";
        }
        $message = "BUST YOUR BOTH OVER 21";
        return $message;
    }
}
