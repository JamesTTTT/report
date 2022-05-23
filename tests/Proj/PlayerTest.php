<?php

namespace App\Adventure;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct Player object and Item object and verify that the item gets added to the bag.
     */
    public function testaddToBag() {
        $player = new Player();
        $item = new Item("item","icon");

        $this->assertInstanceOf("\App\Adventure\Player", $player);
        $player->addToBag($item);

        $res = $player->showBag();
        $this->assertNotEmpty($res);

    }

    /**
     * Construct Player object and Item object and verify that the item gets added
     *  to the bag and then deleted afterwards
     */
    public function testdeleteItem() {
        $player = new Player();
        $item = new Item("item","icon");

        $this->assertInstanceOf("\App\Adventure\Player", $player);
        $player->addToBag($item);
        $player->deleteItem($item);

        $res = $player->showBag();
        $this->assertEmpty($res);

    }

    /**
     * Construct Player object and Item object and verify that the item
     * is in the bag
     */
    public function testcheckItemtrue() {
        $player = new Player();
        $item = new Item("item","icon");

        $this->assertInstanceOf("\App\Adventure\Player", $player);
        $player->addToBag($item);
        $res = $player->checkItem($item);

        $this->assertEquals($res, true);

    }

    /**
     * Construct Player object and Item object and verify that the item
     * is not in the bag
     */
    public function testcheckItemfalse() {
        $player = new Player();
        $item = new Item("item","icon");

        $this->assertInstanceOf("\App\Adventure\Player", $player);
        $res = $player->checkItem($item);

        $this->assertEquals($res, false);

    }
}
