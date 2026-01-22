<?php

namespace App\Test\SIMS;

class Sink extends Furniture
{

    public function useFurniture(): void
    {
        echo "you are washing hands in warm water" . "<br>";
    }
}
