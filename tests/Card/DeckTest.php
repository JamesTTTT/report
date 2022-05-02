<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Deck.
 */
class DeckTest extends TestCase
{
    /**
     * Construct deck object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDeck()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $res = $deck->showDeck();
        $this->assertNotEmpty($res);
    }

    /**
     * Construct deck object and verify that the card objects within are in random order shuffled.
     */
    public function testShuffleDeck()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $unshuffle = $deck->showDeck();
        $shuffled = $deck->shuffleDeck();
        $this->assertNotEquals($unshuffle, $shuffled);
    }

    /**
     * Construct deck object and verify that the drawn card is the
     * same as the top card and that the card count has decreased by
     * one.
     */
    public function testDrawCard()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $topCard = $deck->showCardObj();
        $drawnCard = $deck->drawCard(1);
        
        $this->assertEquals($drawnCard[0], $topCard[51]);
        $this->assertEquals(count($deck->showDeck()), 51);
    }
}
