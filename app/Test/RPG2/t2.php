<?php

// Интерфейс Воина - описывает ЧТО должен уметь воин
interface Warrior
{
    public function attack(): string;

    public function getName(): string;
}

// Класс Рыцаря - РЕАЛИЗУЕТ интерфейс Warrior
class Knight implements Warrior
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function attack(): string
    {
        return "{$this->name} бьет мечом";
    }

    public function getName(): string
    {
        return $this->name;
    }
}


class Archer implements Warrior
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function attack(): string
    {
        return "{$this->name} стреляет из лука";
    }

    public function getName(): string
    {
        return $this->name;
    }
}


class Mage implements Warrior
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function attack(): string
    {
        return "{$this->name} кидает огненный шар";
    }

    public function getName(): string
    {
        return $this->name;
    }
}


$knight = new Knight("Арагорн");
$archer = new Archer("Леголас");
$mage = new Mage("Гэндальф");

echo $knight->attack() . "\n";  // Арагорн бьет мечом
echo $archer->attack() . "\n";  // Леголас стреляет из лука
echo $mage->attack() . "\n";    // Гэндальф кидает огненный шар

