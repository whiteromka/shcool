<?php

namespace App\Test\RPG3;

class ThrowingSpear extends Weapon
{

    public function attack(): void
    {
        echo 'orc aims' . "<br>";
        echo 'orc throws' . "<br>";
        echo 'your spear deals ' . $this->getDamage() . "<br>";
    }
}
