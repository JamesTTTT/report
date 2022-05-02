<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
     * Construct two player objects, game object and deck object and verify that
     * the player asigned as bank loses after hand values are compared. 
     */
    public function testGameCompare()
    {
        $player = new Player();
        $bank = new Player();
        $game = new Game($player, $bank);
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Game", $game);

        $draw = $deck->drawCard(1);
        $player->dealPlayer($draw);

        $draw = $deck->drawCard(1);
        $bank->dealPlayer($draw);

        $res = $game->compare();
        $message = "BANK LOSE // YOU WIN!!";
        $this->assertEquals($res, $message);
    }
}