<?php

namespace App\Adventure;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Manager.
 */
class ManagerTest extends TestCase
{
    /**
     * Construct Manager object and verify that the object adds one diamond
     */
    public function testaddOneDiamond() {
        $game = new Manager();

        $this->assertInstanceOf("\App\Adventure\Manager", $game);
        $game->addOneDiamond();
        $res = $game->getDiamondCount();
        $this->assertEquals($res, 1);

    }

    /**
     * Construct Manager object and verify that the object calculates the correct score with given time
     */
    public function testgetScore() {
        $game = new Manager();

        $this->assertInstanceOf("\App\Adventure\Manager", $game);
        $game->addOneDiamond();
        $res = $game->getScore(3);
        $this->assertEquals($res, 3334);

    }

}