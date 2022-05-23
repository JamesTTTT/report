<?php

namespace App\Adventure;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Item.
 */
class ItemTest extends TestCase
{
    /**
     * Construct item object and verify that the object has the expected
     * properties after being picked.
     */
    public function testcheckItem() {
        $item = new Item("key","icon");

        $this->assertInstanceOf("\App\Adventure\Item", $item);

        $item->pickItem();
        $res = $item->getItem();

        $data = ["key","icon",true];

        $this->assertEquals($res, $data);
    }

}