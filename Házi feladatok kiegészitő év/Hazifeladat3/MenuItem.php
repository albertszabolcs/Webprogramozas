<?php

abstract class MenuItem
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected float $basePrice;

    public function __construct(int $id, string $name, string $description, float $basePrice)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->basePrice = $basePrice;
    }

    abstract public function getPrice(): float;

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getDescription(): string {
        return $this->description;
    }
    public function getBasePrice(): float {
        return $this->basePrice;
    }
}
?>
