<?php
abstract class Warrior {
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    // Абстрактный метод - ДОЛЖЕН быть реализован в дочерних классах
    abstract public function attack(); // можно с контролем типов : string
}

// Конкретный класс Рыцаря
class Knight extends Warrior
{
    public function attack()
    {
        return "{$this->name} бьет мечом";
    }
}

class Archer extends Warrior
{
    public function attack()
    {
        return "{$this->name} стреляет из лука";
    }
}

class Mage extends Warrior
{
    public function attack()
    {
        return "{$this->name} кидает огненный шар";
    }
}

class Barbarian
{
    private int $damage;
    private string $name;

    public function setDamage(int $damage): void
    {
        $this->damage = $damage;
    }

    public function setName(int $name): void
    {
        $this->name = $name;
    }
}

class BigBarbarian
{
    private int $damage;
    private string $name;

    public function __construct(int $damage, string $name)
    {
        $this->damage = $damage;
        $this->name = $name;
    }
}

$bigBarb = new BigBarbarian(15, "Biba");

$barb = new Barbarian();
$barb->setDamage(10);
$barb->setName("Boba");

$knight = new Knight("Арагорн");
$archer = new Archer("Леголас");
$mage = new Mage("Гэндальф");

echo $knight->attack() . "\n";  // Арагорн бьет мечом
echo $archer->attack() . "\n";  // Леголас стреляет из лука
echo $mage->attack() . "\n";    // Гэндальф кидает огненный шар

// Все воины имеют метод getName() из родительского класса
echo $knight->getName() . "\n"; // Артур
