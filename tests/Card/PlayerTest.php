<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct player object then dealing one card to player hand,
     * afterwwards verifing that the hand is not empty 
     */
    public function testdealPlayer()
    {
        $player = new Player();
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Player", $player);

        $draw = $deck->drawCard(1);
        $player->dealPlayer($draw);

        $res = $player->showHand();
        $this->assertNotEmpty($res);
    }

    /**
     * Construct player object then dealing one card to player hand,
     * afterwards verifing that the hand has the expected value.
     */
    public function testhandValue(){
        $player = new Player();
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Player", $player);

        $draw = $deck->drawCard(1);
        $player->dealPlayer($draw);

        $res = $player->handValue();
        $this->assertEquals($res, 14);
    }
}