<?php

namespace App\Test\RPG3;

class Axe extends Weapon
{

    public function attack(): void
    {
        echo 'the axe deals ' . $this->getDamage() . "<br>";
    }
}
