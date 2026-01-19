<?php

namespace App\Test\RPG;

class Rider
{
    private Horse $horse;

    public function setHorse(Horse $horse): void
    {
        $this->horse = $horse;
    }

    /**
     * @param string $rideMode walk or gallop
     * @return void
     */
    public function ride(string $rideMode = "walk"): void
    {
        // Если режим gallop      и  лошадь       является    FastHorse
        if ($rideMode === "gallop" && $this->horse instanceof FastHorse) {
            $this->horse->fastGallop();
        } else {
            // Тут если обычная лошадь или если режим walk или если всадник хочет gallop, но у него обычная лошадь то
            $this->horse->walk();
        }
    }
}
