<?php

namespace App\Test\SIMS;

class Chair extends Furniture
{

    public function useFurniture(): void
    {
        echo "you are sitting comfortably" . "<br>";
    }
}
