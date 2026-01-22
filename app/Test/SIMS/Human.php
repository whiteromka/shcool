<?php

namespace App\Test\SIMS;

class Human
{
    private string $name;
    private string $sex;
    public bool $isHungry = true;
    private Furniture $furniture;

    public function setFurniture(Furniture $furniture): void
    {
        $this->furniture = $furniture;
    }

    public function __construct(string $name, string $sex, Furniture $furniture)
    {
        $this->name = $name;
        $this->sex = $sex;
        $this->furniture = $furniture;
    }

    public function useFurniture(): void
    {
        $this->furniture->useFurniture();
    }

    public function drinkCoffee(): void
    {
        if ($this->furniture instanceof CoffeeMachine) {
            echo "you are drinking coffee. life is good" . "<br>";
        } else {
            echo "use a coffee machine to make coffee" . "<br>";
        }
    }

    public function eat(): void
    {
        if ($this->furniture instanceof Fridge) {
            $this->isHungry = false;
            echo "you are not hungry" . "<br>";
        } else {
            echo "use a fridge to get some food" . "<br>";
        }
    }
}
