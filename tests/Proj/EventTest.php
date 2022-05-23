<?php

namespace App\Adventure;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Event.
 */
class EventTest extends TestCase
{
    /**
     * Construct Event object,Item objects and Player object and verify that the Event
     * transfers the ojects from the player bag and sets correct status.  
     */
    public function testcheckEvent() {
        $key = new Item("key","icon");
        $reward = new Item("reward","icon");
        $player = new Player();
        $event = new Event($key, $reward);

        $this->assertInstanceOf("\App\Adventure\Event", $event);
        $player->addToBag($key);
        $res = $event->checkEvent($player);
        $status = $event->eventStatus();


        $this->assertEquals($res, true);
        $this->assertEquals($status, true);

    }

}