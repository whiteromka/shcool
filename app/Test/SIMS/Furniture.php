<?php

namespace App\Test\SIMS;

abstract class Furniture
{
    private string $material;
    public function __construct(string $material)
    {
        $this->material = $material;
    }

    public abstract function useFurniture(): void;
}
