<?php

namespace App\Test\RPG;

class Horse extends Mount
{
    public function trot(): void
    {
        echo "trotting..." . "<br>";
    }
}
