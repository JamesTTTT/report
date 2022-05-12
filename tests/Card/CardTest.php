<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct card object and verify that the object has the expected
     * properties.
     */
    public function testCreateCard()
    {
        $card = new Card(12,'♣');
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getDetails();
        $expected = [12,'♣','Q'];
        $this->assertEquals($res, $expected);
    }

    /**
     * Construct card object and verify that the object has the expected
     * properties.
     */
    public function testCreateJokerCard()
    {
        $card = new Card(0,'Joker');
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getDetails();
        $expected = [0,'Joker','Jk'];
        $this->assertEquals($res, $expected);
    }
}
