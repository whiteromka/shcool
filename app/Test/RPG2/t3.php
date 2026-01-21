<?php

// Родительский класс
class Animal
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function makeSound()
    {
        return "{$this->name} издает звук";
    }

    public function eat()
    {
        return "{$this->name} ест";
    }
}

// Дочерний класс
class Dog extends Animal
{
    public function makeSound()
    {
        $parentResult = parent::makeSound();
        return $parentResult . ": Гав-гав!";
    }

    public function eat()
    {
        $result = parent::eat();
        return $result . " корм для собак";
    }
}

$dog = new Dog("Пёсель");
echo $dog->makeSound() . "\n"; // Пёсель издает звук: Гав-гав!
echo $dog->eat() . "\n";       // Пёсель ест корм для собак

