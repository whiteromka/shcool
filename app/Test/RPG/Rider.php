<?php

namespace App\Test\RPG;

class Rider
{
    private Mount $mount;

    public function setMount(Mount $mount): void
    {
        $this->mount = $mount;
    }

    /**
     * @param string $rideMode walk, trot or gallop
     * @return void
     */
    public function ride(string $rideMode = "walk"): void
    {
        // Если режим gallop      и  лошадь       является    FastHorse
        if ($rideMode === "gallop" && $this->mount instanceof FastHorse) {
            $this->mount->fastGallop();
            // Если режим trot      и  лошадь       является    Horse
        } else if ($rideMode === "trot" && $this->mount instanceof Horse) {
            $this->mount->trot();
        } else {
            // Тут если обычная лошадь или если режим walk или если всадник хочет gallop, но у него обычная лошадь то
            $this->mount->walk();
        }
    }
}
