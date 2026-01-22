<?php

namespace App\Test\SIMS;

class Fridge extends Furniture
{

    public function useFurniture(): void
    {
        echo "you take an apple" . "<br>";
    }
}
