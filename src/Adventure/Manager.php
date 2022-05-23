<?php

namespace App\Adventure;


/**
 * Manager Class.
 *
 * @author James Taylor
 */
class Manager
{
    private $time_start;
    private int $diamonds;

    /**
     * Creates manager for the game.
     * starts the game timer and sets the amount of picked diamonds to 0
     * @return void
     */
    public function __construct()
    {
        $this->time_start = microtime(true);
        $this->diamonds = 0;
    }

    /**
     * Ends the game timer.
     * Calculates the time in seconds
     * and rounds up the time to whole numbers.
     * @return float
     */
    public function endTimer()
    {
        $time_end = microtime(true);
        $time = $time_end - $this->time_start;
        return ceil($time);
    }

    /**
     * Add a single diamond to the diamond count
     * @return void
     */
    public function addOneDiamond()
    {
        $this->diamonds += 1;
    }

    /**
     * displays the amount of diamonds
     * @return int
     */
    public function getDiamondCount()
    {
        return $this->diamonds;
    }

    /**
     * Calculates the score by dividing the amount of diamonds with
     * the time multiplied by ten thousand.
     * @return float
     */
    public function getScore(int $time)
    {
        $diamonds = $this->diamonds;
        $score = $diamonds / $time * 10000;
        return ceil($score);
    }
}
