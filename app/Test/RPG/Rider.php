<?php

namespace App\Test\RPG;

class Rider
{
    private FastHorse $horse;

    public function setHorse(FastHorse $horse): void
    {
        $this->horse = $horse;
    }

    /**
     * @param string $rideMode walk or gallop
     * @return void
     */
    public function ride(string $rideMode = "walk"): void
    {
        if ($rideMode === "gallop") {
            $this->horse->fastGallop();
        }
        $this->horse->walk();
    }
}
