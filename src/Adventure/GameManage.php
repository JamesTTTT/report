<?php

namespace App\Adventure;

class Manager
{
    private $time_start;
    private int $diamonds;
    public function __construct()
    {
        $this->time_start = microtime(true);
        $this->diamonds = 0;
    }

    public function endTimer()
    {
        $time_end = microtime(true);
        $time = $time_end - $this->time_start;
        return ceil($time);
    }

    public function addOneDiamond()
    {
        $this->diamonds = $this->diamonds + 1;
    }

    public function getDiamondCount()
    {
        return $this->diamonds;
    }

    public function getScore(int $time)
    {
        $diamonds = $this->diamonds;
        $score = $diamonds / $time * 10000;
        return ceil($score);
    }
}
