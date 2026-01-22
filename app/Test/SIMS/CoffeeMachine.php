<?php

namespace App\Test\SIMS;

class CoffeeMachine extends Furniture
{

    public function useFurniture(): void
    {
        echo "you made a cup of hot coffee" . "<br>";
    }
}
