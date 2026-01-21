<?php

namespace App\Test\RPG;

class Mount
{
    private $speed = 1;

    protected $age = 10;

    public function walk(): void
    {
        echo "walking..." . "<br>";
    }

    public function showInfo()
    {
        echo "speed = $this->speed and age = $this->age <br>";
    }
}
