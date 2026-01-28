<?php

namespace App\Test;

use App\Models\User;

class Hunter
{
    private Gun $gun;
    public User $user;
    public string $name;
    private int $age;

    public function __construct(Gun $gun)
    {
        $this->gun = $gun;
    }

    public function getGun(): Gun
    {
        return $this->gun;
    }

    public function setGun(Gun $g): void
    {
        $this->gun = $g;
    }
    //check push
    public function shoot(): void
    {
        $this->gun->shoot();
    }
}
